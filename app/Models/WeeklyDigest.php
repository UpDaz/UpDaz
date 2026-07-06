<?php

namespace App\Models;

use Database\Factories\WeeklyDigestFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    protected $fillable = [
        'week_start',
        'theme',
        'summary',
        'raw_article_ids',
        'post_id',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'week_start' => 'date',
            'raw_article_ids' => 'array',
        ];
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'post_id');
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
