<?php

namespace App\Models;

use App\Enums\TopicStatus;
use Database\Factories\WeeklyDigestFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Str;

class WeeklyDigest extends Model
{
    /** @use HasFactory<WeeklyDigestFactory> */
    use HasFactory;

    /**
     * Marks the start of the appended "Sources" block, so callers can
     * strip it back out (e.g. before sending the content to the AI
     * for revision).
     */
    public const SOURCES_SEPARATOR = "\n\n---\n\n## Sources\n\n";

    /**
     * Topics left unanswered on Discord are dropped after this delay,
     * with one reminder halfway through the interview.
     */
    public const EXPIRES_AFTER_DAYS = 7;

    public const REMIND_AFTER_DAYS = 3;

    protected $fillable = [
        'week_start',
        'theme',
        'topic_title',
        'summary',
        'status',
        'interview_questions',
        'interview_answers',
        'proposed_update',
        'proposed_update_summary',
        'raw_article_ids',
        'post_id',
        'overlapping_article_id',
        'proposed_at',
        'interview_sent_at',
        'reminded_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'week_start' => 'date',
            'raw_article_ids' => 'array',
            'status' => TopicStatus::class,
            'interview_questions' => 'array',
            'interview_answers' => 'array',
            'proposed_at' => 'datetime',
            'interview_sent_at' => 'datetime',
            'reminded_at' => 'datetime',
        ];
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'post_id');
    }

    /**
     * An already published article covering the same subject: the topic
     * is then offered as an update of it rather than a new article.
     */
    public function overlappingArticle(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'overlapping_article_id');
    }

    public function displayTitle(): string
    {
        return $this->topic_title ?: $this->theme;
    }

    /**
     * True when the interview brought first-hand material: the article is
     * then suggested as a "Retour d'expérience" rather than "Veille".
     */
    public function hasFieldExperience(): bool
    {
        return collect($this->interview_answers ?? [])
            ->contains(fn (?string $answer): bool => filled($answer));
    }

    /**
     * @return Collection<int, RawArticle>
     */
    public function rawArticles(): Collection
    {
        return RawArticle::with('source')
            ->whereIn('id', $this->raw_article_ids ?? [])
            ->get();
    }

    /**
     * Markdown "Sources" block listing the raw articles behind this
     * digest, appended to the generated article's content so readers
     * can trace back the information used.
     *
     * Links are written as raw HTML (rather than Markdown link syntax)
     * so we can force them to open in a new tab with `rel="nofollow"` —
     * CommonMark passes raw HTML through unchanged (see the `Markdown`
     * cast, `html_input` defaults to `allow`). Title and URL come from
     * scraped third-party content, so the anchor text is cleaned down
     * to plain, single-line, bounded text via {@see cleanLinkText()}
     * before being escaped: some scrapers pick up a whole listing
     * "card" (author, tags, date...) instead of just a headline, which
     * otherwise breaks the link's display.
     */
    public function sourcesMarkdown(): string
    {
        $rawArticles = $this->rawArticles();

        if ($rawArticles->isEmpty()) {
            return '';
        }

        $list = $rawArticles
            ->map(function (RawArticle $rawArticle) {
                $sourceName = e($this->cleanLinkText($rawArticle->source?->name ?? 'Source inconnue'));
                $url = e($rawArticle->url);
                $title = e($this->cleanLinkText($rawArticle->title));

                return "- <a href=\"{$url}\" target=\"_blank\" rel=\"nofollow noopener noreferrer\">{$title}</a> — {$sourceName}";
            })
            ->implode("\n");

        return self::SOURCES_SEPARATOR . $list;
    }

    /**
     * Input handed to the SEO writer: the editorial synthesis plus each
     * raw article behind it (title, outlet, URL, individual summary).
     * The synthesis alone is only a few sentences with attribution
     * deliberately stripped out, which leaves the writer too little
     * factual material and nothing to cite.
     */
    public function writerBrief(): string
    {
        $sources = $this->rawArticles()
            ->map(function (RawArticle $rawArticle): string {
                $sourceName = $this->cleanLinkText($rawArticle->source?->name ?? 'Source inconnue');
                $title = $this->cleanLinkText($rawArticle->title);
                $summary = trim($rawArticle->summary ?? '');

                return <<<SOURCE
                <source>
                Titre : {$title}
                Média : {$sourceName}
                URL : {$rawArticle->url}
                Résumé : {$summary}
                </source>
                SOURCE;
            })
            ->implode("\n");

        return <<<BRIEF
        <recapitulatif>
        {$this->summary}
        </recapitulatif>

        <sources>
        {$sources}
        </sources>

        <experience>
        {$this->experienceBrief()}
        </experience>
        BRIEF;
    }

    /**
     * Writes the validated update into the published article, keeping its
     * existing sources and adding this week's ones after them.
     */
    public function applyProposedUpdate(): void
    {
        $article = $this->overlappingArticle;

        if (! $article || $this->proposed_update === null) {
            return;
        }

        $sources = $this->sourceLines((string) $article->getRawOriginal('content'))
            ->merge($this->sourceLines($this->sourcesMarkdown()))
            ->unique();

        $article->update([
            'content' => $sources->isEmpty()
                ? $this->proposed_update
                : $this->proposed_update . self::SOURCES_SEPARATOR . $sources->implode("\n"),
        ]);

        $this->update(['proposed_update' => null]);
    }

    /**
     * @return SupportCollection<int, string>
     */
    private function sourceLines(string $content): SupportCollection
    {
        if (! str_contains($content, self::SOURCES_SEPARATOR)) {
            return collect();
        }

        return Str::of($content)
            ->after(self::SOURCES_SEPARATOR)
            ->explode("\n")
            ->map(fn (string $line): string => trim($line))
            ->filter()
            ->values();
    }

    /**
     * The interview as question/answer pairs, or an explicit "none" so the
     * writer never fills the gap with made-up experience.
     */
    private function experienceBrief(): string
    {
        if (! $this->hasFieldExperience()) {
            return 'Aucune expérience fournie.';
        }

        return collect($this->interview_questions ?? [])
            ->map(function (string $question, int $index): ?string {
                $answer = trim($this->interview_answers[$index] ?? '');

                return $answer === '' ? null : "Question : {$question}\nRéponse : {$answer}";
            })
            ->filter()
            ->implode("\n\n");
    }

    /**
     * Strips any tags, collapses whitespace/newlines to single spaces,
     * and bounds the length, so text placed inside an `<a>` can never
     * break its display regardless of how messy the source data is.
     */
    private function cleanLinkText(string $text): string
    {
        return Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($text))), 150);
    }

    /**
     * @return array<int, string>
     */
    public function imageUrls(): array
    {
        return $this->rawArticles()
            ->pluck('image_url')
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    /**
     * Inserts one source image before each H2 heading of the generated
     * Markdown, until the available images run out (remaining headings
     * are left as-is). Images all come from raw articles sharing this
     * digest's theme, which is as close to "related to the content" as
     * we can get without a dedicated per-heading matching step.
     *
     * Only used for the initial generation ({@see GenerateSeoArticleJob}):
     * on revision, the AI sees and keeps ownership of any `<img>` tags
     * already in the content, so it can act on requests like "remove
     * the first image" — re-injecting here unconditionally would just
     * silently undo that.
     *
     * The source image can be taken down after generation (deleted on
     * the source site), so rather than verifying availability up front
     * we let the browser fail silently: `onerror` removes the `<img>`
     * outright instead of showing a broken-image icon.
     */
    public function injectSourceImages(string $markdown): string
    {
        $images = $this->imageUrls();

        if ($images === []) {
            return $markdown;
        }

        $index = 0;

        return preg_replace_callback('/^## .+$/m', function (array $matches) use ($images, &$index): string {
            if (! isset($images[$index])) {
                return $matches[0];
            }

            $url = e($images[$index]);
            $index++;

            return "<img src=\"{$url}\" alt=\"\" loading=\"lazy\" onerror=\"this.remove()\">\n\n{$matches[0]}";
        }, $markdown);
    }
}
