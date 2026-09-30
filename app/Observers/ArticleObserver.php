<?php

namespace App\Observers;

use App\Models\Article;
use App\Models\Redirect;
use Illuminate\Support\Facades\Artisan;

class ArticleObserver
{
    public function created(Article $article): void
    {
        $this->regenerateSitemapIfPublished($article);
    }

    public function updated(Article $article): void
    {
        $previousPath = $article->publicPath(original: true);
        $currentPath = $article->publicPath();

        $hasMoved = $previousPath !== null && $previousPath !== $currentPath;

        if ($hasMoved && $article->wasReadable() && $article->can_be_read) {
            Redirect::register($previousPath, $currentPath);
        }

        if (! $article->wasChanged('is_published') && ! $hasMoved) {
            return;
        }

        Artisan::call('sitemap:generate');
    }

    public function deleted(Article $article): void
    {
        $this->regenerateSitemapIfPublished($article);
    }

    public function saved(Article $article): void
    {
        $this->forgetRedirectOnceReadable($article);

        if ($article->category_id === null) {
            return;
        }

        if (! $article->wasChanged('category_id') && ! $article->wasRecentlyCreated) {
            return;
        }

        $article->categories()->syncWithoutDetaching([$article->category_id]);
    }

    /**
     * A republished article, or a new one reusing an old URL, must be
     * served again instead of its redirect.
     */
    private function forgetRedirectOnceReadable(Article $article): void
    {
        if (! $article->can_be_read) {
            return;
        }

        $currentPath = $article->publicPath();

        if ($currentPath === null) {
            return;
        }

        Redirect::forget($currentPath);
    }

    private function regenerateSitemapIfPublished(Article $article): void
    {
        if (! $article->is_published) {
            return;
        }

        Artisan::call('sitemap:generate');
    }
}
