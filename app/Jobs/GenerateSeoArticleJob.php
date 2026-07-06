<?php

namespace App\Jobs;

use App\AI\Agents\SeoArticleWriterAgent;
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

class GenerateSeoArticleJob implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $schema = new ObjectSchema('article', 'Article de blog', [
            new StringSchema('title', ''),
            new StringSchema('catch_phrase', 'Accroche d\'une phrase affichée sous le titre'),
            new StringSchema('meta_description', ''),
            new StringSchema('slug', ''),
            new StringSchema('content', 'Contenu en Markdown'),
            new ArraySchema('tags', '', new StringSchema('tag', '')),
        ], ['title', 'catch_phrase', 'meta_description', 'slug', 'content', 'tags']);

        $throttle = max(0, (int) config('ai.throttle_seconds', 5));

        $digests = WeeklyDigest::whereNull('post_id')
            ->where('week_start', now()->startOfWeek())
            ->get();

        notice('[GenerateSeoArticleJob] Démarrage', ['digests_a_traiter' => $digests->count()]);

        $articlesCreated = 0;

        $digests->each(function (WeeklyDigest $digest) use ($schema, $throttle, &$articlesCreated) {

            try {
                $article = (new SeoArticleWriterAgent())
                    ->withSchema($schema)
                    ->prompt($digest->summary);
            } catch (Throwable $e) {
                warning('[GenerateSeoArticleJob] Échec de génération d\'article', [
                    'digest_id' => $digest->id,
                    'error' => $e->getMessage(),
                ]);

                return;
            } finally {
                sleep($throttle);
            }

            $content = $digest->injectSourceImages($article->content) . $digest->sourcesMarkdown();

            $post = Article::create([
                'title' => $article->title,
                'catch_phrase' => $article->catch_phrase,
                'slug' => $article->slug,
                'meta_description' => $article->meta_description,
                'content' => $content,
                'tags' => $article->tags,
                'category_id' => Category::where('name', $digest->theme)->value('id'),
                'is_published' => false, // jamais publié automatiquement
                'generated_by_agent' => true,
            ]);

            $digest->update(['post_id' => $post->id]);

            $articlesCreated++;

            notice('[GenerateSeoArticleJob] Article généré', [
                'article_id' => $post->id,
                'digest_id' => $digest->id,
                'title' => $post->title,
            ]);

            // notifie l'équipe éditoriale
            Notification::route('discord', config('blog.discord_channel_id'))
                ->notify(new DraftReadyForReview($post));
        });
    }
}
