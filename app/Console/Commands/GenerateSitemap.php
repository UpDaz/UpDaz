<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate the sitemap.';

    public function handle(): void
    {
        $articles = Article::query()
            ->select(['slug', 'updated_at'])
            ->where('is_published', true)
            ->get()
            ->keyBy('slug');

        $categories = Category::query()
            ->select(['slug', 'updated_at'])
            ->where('is_active', true)
            ->get()
            ->keyBy('slug');

        $redirectPaths = ['/prestashop', '/laravel', '/sur-mesure-bordeaux'];

        SitemapGenerator::create(config('app.url'))
            ->hasCrawled(function (Url $url) use ($articles, $categories, $redirectPaths) {
                if (in_array($url->path(), $redirectPaths, true)) {
                    return;
                }

                $url->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY);

                if ($url->path() === '/') {
                    $url->setPriority(1.0);
                    $url->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY);

                    return $url;
                }

                if (substr($url->path(), -1, 1) === '/') {
                    return;
                }

                if ($url->segment(1) === 'articles') {
                    $articleSlug = $url->segment(3);
                    $categorySlug = $url->segment(2);

                    if ($articleSlug !== null) {
                        $url->setPriority(0.5);
                        $article = $articles->get($articleSlug);

                        if ($article) {
                            $url->setLastModificationDate($article->updated_at);
                        }
                    } elseif ($categorySlug !== null) {
                        $url->setPriority(0.5);
                        $category = $categories->get($categorySlug);

                        if ($category) {
                            $url->setLastModificationDate($category->updated_at);
                        }
                    } else {
                        $url->setPriority(0.6);
                        $url->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY);
                    }

                    return $url;
                }

                if ($url->segment(1) === 'mentions-legales') {
                    $url->setPriority(0.1);
                    $url->setChangeFrequency(Url::CHANGE_FREQUENCY_NEVER);

                    return $url;
                }

                $url->setPriority(0.8);

                return $url;
            })
            ->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap file generated successfully !');
    }
}
