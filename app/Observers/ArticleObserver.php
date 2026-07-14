<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Facades\Artisan;

class ArticleObserver
{
    public function created(Article $article): void
    {
        $this->regenerateSitemapIfPublished($article);
    }

    public function updated(Article $article): void
    {
        if (! $article->wasChanged('is_published')) {
            return;
        }

        $this->regenerateSitemapIfPublished($article);
    }

    private function regenerateSitemapIfPublished(Article $article): void
    {
        if (! $article->is_published) {
            return;
        }

        Artisan::call('sitemap:generate');
    }
}
