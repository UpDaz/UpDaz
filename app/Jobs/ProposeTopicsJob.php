<?php

namespace App\Jobs;

use App\AI\Agents\TopicProposerAgent;
use App\Enums\TopicStatus;
use App\Models\Article;
use App\Models\WeeklyDigest;
use App\Notifications\TopicsProposed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;
use Prism\Prism\Schema\EnumSchema;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\StringSchema;
use Throwable;

/**
 * Turns this week's digests into topics offered on Discord, each flagged
 * as a new article or as an update of an already published one.
 */
class ProposeTopicsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Enum sentinel for "no overlapping article" (see the matching
     * comment in AnalyzeAndGroupArticlesJob on nullable enums).
     */
    private const NO_OVERLAP = 'Aucun';

    public function handle(): void
    {
        $digests = WeeklyDigest::query()
            ->where('status', TopicStatus::Proposed)
            ->whereNull('proposed_at')
            ->where('week_start', now()->startOfWeek())
            ->get();

        notice('[ProposeTopicsJob] Démarrage', ['sujets_a_proposer' => $digests->count()]);

        if ($digests->isEmpty()) {
            return;
        }

        $publishedArticles = Article::query()->readable()->whereNotNull('category_id')->get();
        $throttle = max(0, (int) config('ai.throttle_seconds', 5));

        $digests->each(function (WeeklyDigest $digest) use ($publishedArticles, $throttle): void {
            try {
                $proposal = (new TopicProposerAgent())
                    ->withSchema($this->schema($publishedArticles))
                    ->prompt($this->brief($digest, $publishedArticles));
            } catch (Throwable $e) {
                warning('[ProposeTopicsJob] Échec de proposition du sujet', [
                    'digest_id' => $digest->id,
                    'error' => $e->getMessage(),
                ]);

                return;
            } finally {
                sleep($throttle);
            }

            $digest->update([
                'topic_title' => trim((string) ($proposal->topic_title ?? '')) ?: null,
                'overlapping_article_id' => $publishedArticles->firstWhere('slug', $proposal->overlapping_article ?? null)?->id,
                'proposed_at' => now(),
            ]);
        });

        $proposedDigests = $digests->filter(fn (WeeklyDigest $digest): bool => $digest->proposed_at !== null);

        if ($proposedDigests->isEmpty()) {
            return;
        }

        try {
            Notification::route('discord', config('blog.discord_channel_id'))
                ->notify(new TopicsProposed($proposedDigests->load('overlappingArticle')->values()));
        } catch (Throwable $e) {
            warning('[ProposeTopicsJob] Échec d\'envoi des sujets sur Discord', ['error' => $e->getMessage()]);

            return;
        }

        notice('[ProposeTopicsJob] Sujets proposés', ['digest_ids' => $proposedDigests->pluck('id')->all()]);
    }

    /**
     * @param  Collection<int, Article>  $publishedArticles
     */
    private function schema(Collection $publishedArticles): ObjectSchema
    {
        return new ObjectSchema('topic', 'Sujet d\'article', [
            new StringSchema('topic_title', 'Titre du sujet, moins de 80 caractères'),
            new EnumSchema(
                'overlapping_article',
                'Slug de l\'article publié qui traite déjà ce sujet, ou "' . self::NO_OVERLAP . '"',
                [...$publishedArticles->pluck('slug')->all(), self::NO_OVERLAP],
            ),
        ], ['topic_title', 'overlapping_article']);
    }

    /**
     * @param  Collection<int, Article>  $publishedArticles
     */
    private function brief(WeeklyDigest $digest, Collection $publishedArticles): string
    {
        $articles = $publishedArticles
            ->map(fn (Article $article): string => "- {$article->slug} : {$article->title}. {$article->catch_phrase}")
            ->implode("\n");

        return <<<BRIEF
        <synthese>
        {$digest->summary}
        </synthese>

        <articles_publies>
        {$articles}
        </articles_publies>
        BRIEF;
    }
}
