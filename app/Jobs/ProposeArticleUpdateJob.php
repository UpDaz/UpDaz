<?php

namespace App\Jobs;

use App\AI\Agents\ArticleUpdaterAgent;
use App\Enums\TopicStatus;
use App\Models\WeeklyDigest;
use App\Notifications\ArticleUpdateReadyForReview;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\StringSchema;
use Throwable;

/**
 * Enriches the published article that already covers a topic instead of
 * writing a competing one. The change is stored on the digest until the
 * editor applies it (see WeeklyDigest::applyProposedUpdate()).
 */
class ProposeArticleUpdateJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly WeeklyDigest $digest,
    ) {
    }

    public function handle(): void
    {
        $article = $this->digest->overlappingArticle;

        if (! $article) {
            warning('[ProposeArticleUpdateJob] Aucun article à mettre à jour', ['digest_id' => $this->digest->id]);

            return;
        }

        notice('[ProposeArticleUpdateJob] Démarrage', [
            'digest_id' => $this->digest->id,
            'article_id' => $article->id,
        ]);

        $schema = new ObjectSchema('update', 'Mise à jour d\'article', [
            new StringSchema('content', 'Contenu complet mis à jour, en Markdown, sans H1 ni section Sources'),
            new StringSchema('changes_summary', 'Un changement par ligne, commençant par « Ajout : », « Modification : » ou « Suppression : »'),
        ], ['content', 'changes_summary']);

        $currentContent = Str::before((string) $article->getRawOriginal('content'), WeeklyDigest::SOURCES_SEPARATOR);

        try {
            $update = (new ArticleUpdaterAgent())
                ->withSchema($schema)
                ->prompt(<<<PROMPT
                {$this->digest->writerBrief()}

                <article_existant>
                Titre : {$article->title}

                {$currentContent}
                </article_existant>
                PROMPT);
        } catch (Throwable $e) {
            warning('[ProposeArticleUpdateJob] Échec de la mise à jour', [
                'digest_id' => $this->digest->id,
                'error' => $e->getMessage(),
            ]);

            $this->digest->update(['status' => TopicStatus::Proposed]);

            return;
        }

        $this->digest->update([
            'status' => TopicStatus::Drafted,
            'proposed_update' => $update->content,
            'proposed_update_summary' => $update->changes_summary,
        ]);

        Notification::route('discord', config('blog.discord_channel_id'))
            ->notify(new ArticleUpdateReadyForReview($this->digest));

        notice('[ProposeArticleUpdateJob] Mise à jour proposée', ['digest_id' => $this->digest->id]);
    }
}
