<?php

namespace App\Jobs;

use App\AI\Agents\SeoArticleWriterAgent;
use App\Models\Article;
use App\Models\WeeklyDigest;
use App\Notifications\DraftReadyForReview;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Prism\Prism\Schema\ArraySchema;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\StringSchema;

class ReviseSeoArticleJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly Article $article,
        public readonly string $feedback,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        notice('[ReviseSeoArticleJob] Démarrage', [
            'article_id' => $this->article->id,
            'feedback' => $this->feedback,
        ]);

        $schema = new ObjectSchema('article', 'Article de blog', [
            new StringSchema('title', 'Titre SEO de moins de 60 caractères, mot-clé principal au début'),
            new StringSchema('catch_phrase', 'Accroche d\'une phrase affichée sous le titre, sans répéter le titre'),
            new StringSchema('meta_description', 'Meta description de 140 à 155 caractères avec le mot-clé principal'),
            new StringSchema('slug', 'Slug de 3 à 6 mots en minuscules séparés par des tirets'),
            new StringSchema('content', 'Contenu en Markdown, sans H1 ni section Sources'),
            new ArraySchema('tags', 'Entre 3 et 5 tags', new StringSchema('tag', '')),
        ], ['title', 'catch_phrase', 'meta_description', 'slug', 'content', 'tags']);

        $digest = WeeklyDigest::where('post_id', $this->article->id)->first();

        $currentContent = Str::before($this->article->getRawOriginal('content'), WeeklyDigest::SOURCES_SEPARATOR);
        debug('Feedback', ['feedback' => $this->feedback]);
        $brief = $digest?->writerBrief() ?? '';

        $input = <<<PROMPT
        {$brief}

        Voici l'article précédemment généré :

        Titre : {$this->article->title}
        Contenu :
        {$currentContent}

        Applique les modifications suivantes demandées par
        l'équipe éditoriale, et de renvoi l'article complet révisé :
        {$this->feedback}
        PROMPT;

        $revised = (new SeoArticleWriterAgent())
            ->withSchema($schema)
            ->prompt($input);

        debug('[ReviseSeoArticleJob] Nouvelle version reçue', [
            'article_id' => $this->article->id,
            'title' => $revised->title,
        ]);

        $content = $revised->content . ($digest?->sourcesMarkdown() ?? '');
        debug('Nouveau contenu article', ['content' => $content]);
        $this->article->update([
            'title' => $revised->title,
            'catch_phrase' => $revised->catch_phrase,
            'slug' => $revised->slug,
            'meta_description' => $revised->meta_description,
            'content' => $content,
            'tags' => $revised->tags,
        ]);

        Notification::route('discord', config('blog.discord_channel_id'))
            ->notify(new DraftReadyForReview($this->article));

        notice('[ReviseSeoArticleJob] Terminé', ['article_id' => $this->article->id]);
    }
}
