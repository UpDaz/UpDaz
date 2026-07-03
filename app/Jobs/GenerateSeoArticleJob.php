<?php

namespace App\Jobs;

use App\AI\Agents\SeoArticleWriterAgent;
use App\Models\Article;
use App\Models\WeeklyDigest;
use App\Notifications\DraftReadyForReview;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;
use Prism\Prism\Schema\ArraySchema;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\StringSchema;

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
            new StringSchema('meta_description', ''),
            new StringSchema('slug', ''),
            new StringSchema('content', 'Contenu en Markdown'),
            new ArraySchema('tags', '', new StringSchema('tag', '')),
        ]);

        WeeklyDigest::whereNull('post_id')
            ->where('week_start', now()->startOfWeek())
            ->each(function (WeeklyDigest $digest) use ($schema) {
                $article = (new SeoArticleWriterAgent())
                    ->withSchema($schema)
                    ->prompt($digest->summary);

                $post = Article::create([
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'meta_description' => $article->meta_description,
                    'content' => $article->content,
                    'tags' => $article->tags,
                    'is_published' => false, // jamais publié automatiquement
                    'generated_by_agent' => true,
                ]);

                $digest->update(['post_id' => $post->id]);

                // notifie l'équipe éditoriale
                Notification::route('discord', config('blog.discord_channel_id'))
                    ->notify(new DraftReadyForReview($post));
            });
    }
}
