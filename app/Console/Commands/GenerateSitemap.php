<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate the sitemap.';

    /**
     * Service landing pages each embed a `<x-last-articles :categoryId="…">`
     * block (see resources/views/elements/{webflow,laravel,ecommerce}), so
     * their real lastmod tracks the newest published article in that
     * category rather than a template edit.
     *
     * @var array<string, int>
     */
    private const SERVICE_PAGE_CATEGORIES = [
        'webflow' => 1,
        'laravel' => 3,
        'ecommerce' => 4,
    ];

    /**
     * Built directly from routes and the database rather than crawling
     * the live site over HTTP: it's an order of magnitude faster and
     * deterministic, which makes it safe to run synchronously right
     * after an article is published, not just once a day.
     */
    public function handle(): void
    {
        $sitemap = Sitemap::create();

        $latestArticleUpdate = $this->latestPublishedUpdate();

        $home = Url::create(route('home'))
            ->setPriority(1.0)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY);

        $articles = Url::create(route('articles'))
            ->setPriority(0.6)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY);

        if ($latestArticleUpdate) {
            $home->setLastModificationDate($latestArticleUpdate);
            $articles->setLastModificationDate($latestArticleUpdate);
        }

        $sitemap->add($home)->add($articles);

        $sitemap->add(
            Url::create(route('legal-notices'))
                ->setPriority(0.1)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_NEVER)
        );

        foreach (self::SERVICE_PAGE_CATEGORIES as $routeName => $categoryId) {
            $servicePage = Url::create(route($routeName))
                ->setPriority(0.8)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY);

            $lastModified = $this->latestPublishedUpdate($categoryId);

            if ($lastModified) {
                $servicePage->setLastModificationDate($lastModified);
            }

            $sitemap->add($servicePage);
        }

        Category::query()
            ->where('is_active', true)
            ->get()
            ->each(function (Category $category) use ($sitemap): void {
                $categoryPage = Url::create(route('category', ['slug' => $category->slug]))
                    ->setPriority(0.6)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY);

                if ($category->updated_at) {
                    $categoryPage->setLastModificationDate($category->updated_at);
                }

                $sitemap->add($categoryPage);
            });

        Article::query()
            ->where('is_published', true)
            ->whereNotNull('category_id')
            ->with('category')
            ->get()
            ->each(function (Article $article) use ($sitemap): void {
                $articlePage = Url::create(route('article', [
                    'categorySlug' => $article->category->slug,
                    'slug' => $article->slug,
                ]))
                    ->setPriority(0.5)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY);

                if ($article->updated_at) {
                    $articlePage->setLastModificationDate($article->updated_at);
                }

                $sitemap->add($articlePage);
            });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap file generated successfully !');
    }

    private function latestPublishedUpdate(?int $categoryId = null): ?Carbon
    {
        $updatedAt = Article::query()
            ->where('is_published', true)
            ->when($categoryId, fn ($query) => $query->where('category_id', $categoryId))
            ->max('updated_at');

        return $updatedAt ? Carbon::parse($updatedAt) : null;
    }
}
