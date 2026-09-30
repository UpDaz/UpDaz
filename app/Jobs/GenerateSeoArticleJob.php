<?php

namespace App\Jobs;

use App\AI\Agents\SeoArticleWriterAgent;
use App\Enums\TopicStatus;
use App\Models\Article;
use App\Models\Category;
use App\Models\WeeklyDigest;
use App\Notifications\DraftReadyForReview;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;
use Prism\Prism\Schema\ArraySchema;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\StringSchema;
use Throwable;

/**
 * Writes the draft of a topic chosen on Discord, from its sources and
 * the interview answers (if any), then asks for a review.
 */
class GenerateSeoArticleJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly WeeklyDigest $digest,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->digest->post_id !== null) {
            notice('[GenerateSeoArticleJob] Sujet déjà rédigé, ignoré', ['digest_id' => $this->digest->id]);

            return;
        }

        notice('[GenerateSeoArticleJob] Démarrage', [
            'digest_id' => $this->digest->id,
            'avec_experience' => $this->digest->hasFieldExperience(),
        ]);

        $schema = new ObjectSchema('article', 'Article de blog', [
            new StringSchema('title', 'Titre SEO de moins de 60 caractères, mot-clé principal au début'),
            new StringSchema('catch_phrase', 'Accroche d\'une phrase affichée sous le titre, sans répéter le titre'),
            new StringSchema('meta_description', 'Meta description de 140 à 155 caractères avec le mot-clé principal'),
            new StringSchema('slug', 'Slug de 3 à 6 mots en minuscules séparés par des tirets'),
            new StringSchema('content', 'Contenu en Markdown, sans H1 ni section Sources'),
            new ArraySchema('tags', 'Entre 3 et 5 tags', new StringSchema('tag', '')),
        ], ['title', 'catch_phrase', 'meta_description', 'slug', 'content', 'tags']);

        try {
            $article = (new SeoArticleWriterAgent())
                ->withSchema($schema)
                ->prompt($this->digest->writerBrief());
        } catch (Throwable $e) {
            warning('[GenerateSeoArticleJob] Échec de génération d\'article', [
                'digest_id' => $this->digest->id,
                'error' => $e->getMessage(),
            ]);

            // Back to the interview, so "Répondre" or "Pas d'expérience"
            // can be clicked again to retry.
            $this->digest->update(['status' => TopicStatus::Interviewing]);

            return;
        }

        $content = $this->digest->injectSourceImages($article->content) . $this->digest->sourcesMarkdown();

        $post = Article::create([
            'title' => $article->title,
            'catch_phrase' => $article->catch_phrase,
            'slug' => $article->slug,
            'meta_description' => $article->meta_description,
            'content' => $content,
            'tags' => $article->tags,
            'category_id' => Category::where('name', $this->digest->theme)->value('id'),
            'is_published' => false, // jamais publié automatiquement
            'generated_by_agent' => true,
        ]);

        $this->digest->update([
            'post_id' => $post->id,
            'status' => TopicStatus::Drafted,
        ]);

        notice('[GenerateSeoArticleJob] Article généré', [
            'article_id' => $post->id,
            'digest_id' => $this->digest->id,
            'title' => $post->title,
        ]);

        try {
            Notification::route('discord', config('blog.discord_channel_id'))
                ->notify(new DraftReadyForReview($post));
        } catch (Throwable $e) {
            warning('[GenerateSeoArticleJob] Échec d\'envoi de la demande de relecture Discord', [
                'article_id' => $post->id,
                'channel_id' => config('blog.discord_channel_id'),
                'error' => $e->getMessage(),
            ]);

            return;
        }

        notice('[GenerateSeoArticleJob] Demande de relecture envoyée', ['article_id' => $post->id]);
    }
}
