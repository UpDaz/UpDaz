<?php

namespace Tests\Feature\Jobs;

use App\Enums\SourceType;
use App\Jobs\FetchArticlesJob;
use App\Models\RawArticle;
use App\Models\Source;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class FetchArticlesJobTest extends TestCase
{
    use RefreshDatabase;

    private function articleHtml(string $paragraph): string
    {
        return "<html><body><article><p>{$paragraph}</p><p>Second paragraph with more content.</p></article></body></html>";
    }

    public function testFetchesAndStoresArticlesFromAnRssSource(): void
    {
        $rss = <<<'XML'
        <?xml version="1.0" encoding="UTF-8"?>
        <rss version="2.0">
            <channel>
                <title>Example Feed</title>
                <item>
                    <title>Hello World Article</title>
                    <link>https://example-rss.test/articles/hello-world</link>
                    <pubDate>Mon, 01 Jan 2026 10:00:00 +0000</pubDate>
                </item>
            </channel>
        </rss>
        XML;

        Http::fake([
            'https://example-rss.test/feed' => Http::response($rss, 200),
            'https://example-rss.test/articles/hello-world' => Http::response(
                $this->articleHtml('This is the full article content fetched from the page.'),
                200
            ),
        ]);

        Source::factory()->create([
            'url' => 'https://example-rss.test/feed',
            'type' => SourceType::Rss,
            'active' => true,
        ]);

        (new FetchArticlesJob())->handle();

        $this->assertDatabaseCount(RawArticle::class, 1);

        $article = RawArticle::first();

        $this->assertSame('Hello World Article', $article->title);
        $this->assertSame('https://example-rss.test/articles/hello-world', $article->url);
        $this->assertStringContainsString('full article content', $article->content);
        $this->assertNotNull($article->published_at);
        $this->assertNull($article->image_url);
    }

    public function testExtractsTheOpenGraphImageWhenPresent(): void
    {
        $rss = <<<'XML'
        <?xml version="1.0" encoding="UTF-8"?>
        <rss version="2.0">
            <channel>
                <item>
                    <title>Hello World Article</title>
                    <link>https://example-rss.test/articles/hello-world</link>
                    <pubDate>Mon, 01 Jan 2026 10:00:00 +0000</pubDate>
                </item>
            </channel>
        </rss>
        XML;

        $html = <<<'HTML'
        <html>
        <head><meta property="og:image" content="https://example-rss.test/cover.jpg"></head>
        <body><article><p>Contenu avec une image.</p><p>Deuxième paragraphe du texte.</p></article></body>
        </html>
        HTML;

        Http::fake([
            'https://example-rss.test/feed' => Http::response($rss, 200),
            'https://example-rss.test/articles/hello-world' => Http::response($html, 200),
        ]);

        Source::factory()->create([
            'url' => 'https://example-rss.test/feed',
            'type' => SourceType::Rss,
            'active' => true,
        ]);

        (new FetchArticlesJob())->handle();

        $this->assertSame('https://example-rss.test/cover.jpg', RawArticle::first()->image_url);
    }

    public function testFallsBackToTheFirstArticleImageWhenNoOpenGraphImage(): void
    {
        $rss = <<<'XML'
        <?xml version="1.0" encoding="UTF-8"?>
        <rss version="2.0">
            <channel>
                <item>
                    <title>Hello World Article</title>
                    <link>https://example-rss.test/articles/hello-world</link>
                    <pubDate>Mon, 01 Jan 2026 10:00:00 +0000</pubDate>
                </item>
            </channel>
        </rss>
        XML;

        $html = <<<'HTML'
        <html><body><article>
            <img src="https://example-rss.test/inline.jpg">
            <p>Contenu avec une image.</p><p>Deuxième paragraphe du texte.</p>
        </article></body></html>
        HTML;

        Http::fake([
            'https://example-rss.test/feed' => Http::response($rss, 200),
            'https://example-rss.test/articles/hello-world' => Http::response($html, 200),
        ]);

        Source::factory()->create([
            'url' => 'https://example-rss.test/feed',
            'type' => SourceType::Rss,
            'active' => true,
        ]);

        (new FetchArticlesJob())->handle();

        $this->assertSame('https://example-rss.test/inline.jpg', RawArticle::first()->image_url);
    }

    public function testFetchesAndStoresArticlesFromAScraperSource(): void
    {
        $listing = <<<'HTML'
        <html><body>
            <a href="/blog/my-great-article">This Is A Great Article Title</a>
        </body></html>
        HTML;

        Http::fake([
            'https://example-scraper.test/blog' => Http::response($listing, 200),
            'https://example-scraper.test/blog/my-great-article' => Http::response(
                $this->articleHtml('Scraped article content goes here for the test.'),
                200
            ),
        ]);

        Source::factory()->create([
            'url' => 'https://example-scraper.test/blog',
            'type' => SourceType::Scraper,
            'active' => true,
        ]);

        (new FetchArticlesJob())->handle();

        $this->assertDatabaseCount(RawArticle::class, 1);

        $article = RawArticle::first();

        $this->assertSame('This Is A Great Article Title', $article->title);
        $this->assertSame('https://example-scraper.test/blog/my-great-article', $article->url);
        $this->assertStringContainsString('Scraped article content', $article->content);
        $this->assertNull($article->published_at);
        $this->assertNull($article->image_url);
    }

    public function testCollapsesWhitespaceAndBoundsTheLengthOfScrapedTitles(): void
    {
        // A card-style listing where the anchor wraps the whole card
        // (heading, author, tags, date...) instead of just the headline.
        $messyTitle = str_repeat("\n            Author: Alex Six\n            7 stars\n    ", 20);

        $listing = <<<HTML
        <html><body>
            <a href="/blog/my-great-article">This Is A Great Article Title{$messyTitle}</a>
        </body></html>
        HTML;

        Http::fake([
            'https://example-scraper.test/blog' => Http::response($listing, 200),
            'https://example-scraper.test/blog/my-great-article' => Http::response(
                $this->articleHtml('Scraped article content goes here for the test.'),
                200
            ),
        ]);

        Source::factory()->create([
            'url' => 'https://example-scraper.test/blog',
            'type' => SourceType::Scraper,
            'active' => true,
        ]);

        (new FetchArticlesJob())->handle();

        $title = RawArticle::first()->title;

        $this->assertStringStartsWith('This Is A Great Article Title', $title);
        $this->assertStringNotContainsString("\n", $title);
        $this->assertLessThanOrEqual(200, mb_strlen($title));
    }

    public function testIgnoresInactiveSources(): void
    {
        Http::fake();

        Source::factory()->create([
            'url' => 'https://example-inactive.test/feed',
            'type' => SourceType::Rss,
            'active' => false,
        ]);

        (new FetchArticlesJob())->handle();

        Http::assertNothingSent();
        $this->assertDatabaseCount(RawArticle::class, 0);
    }

    public function testDoesNotDuplicateArticlesAlreadyFetched(): void
    {
        $rss = <<<'XML'
        <?xml version="1.0" encoding="UTF-8"?>
        <rss version="2.0">
            <channel>
                <item>
                    <title>Hello World Article</title>
                    <link>https://example-rss.test/articles/hello-world</link>
                    <pubDate>Mon, 01 Jan 2026 10:00:00 +0000</pubDate>
                </item>
            </channel>
        </rss>
        XML;

        Http::fake([
            'https://example-rss.test/feed' => Http::response($rss, 200),
            'https://example-rss.test/articles/hello-world' => Http::response(
                $this->articleHtml('Content.'),
                200
            ),
        ]);

        $source = Source::factory()->create([
            'url' => 'https://example-rss.test/feed',
            'type' => SourceType::Rss,
            'active' => true,
        ]);

        RawArticle::factory()->for($source)->create([
            'url' => 'https://example-rss.test/articles/hello-world',
        ]);

        (new FetchArticlesJob())->handle();

        $this->assertDatabaseCount(RawArticle::class, 1);
    }

    public function testCapsTheNumberOfArticlesFetchedPerSourceWhenConfigured(): void
    {
        config(['blog.max_articles_per_source' => 1]);

        $rss = <<<'XML'
        <?xml version="1.0" encoding="UTF-8"?>
        <rss version="2.0">
            <channel>
                <item>
                    <title>First Article</title>
                    <link>https://example-rss.test/articles/first</link>
                    <pubDate>Mon, 01 Jan 2026 10:00:00 +0000</pubDate>
                </item>
                <item>
                    <title>Second Article</title>
                    <link>https://example-rss.test/articles/second</link>
                    <pubDate>Mon, 01 Jan 2026 10:00:00 +0000</pubDate>
                </item>
            </channel>
        </rss>
        XML;

        Http::fake([
            'https://example-rss.test/feed' => Http::response($rss, 200),
            'https://example-rss.test/articles/first' => Http::response(
                $this->articleHtml('First article content.'),
                200
            ),
            'https://example-rss.test/articles/second' => Http::response(
                $this->articleHtml('Second article content.'),
                200
            ),
        ]);

        Source::factory()->create([
            'url' => 'https://example-rss.test/feed',
            'type' => SourceType::Rss,
            'active' => true,
        ]);

        (new FetchArticlesJob())->handle();

        $this->assertDatabaseCount(RawArticle::class, 1);
        $this->assertSame('First Article', RawArticle::first()->title);
        Http::assertNotSent(fn ($request) => $request->url() === 'https://example-rss.test/articles/second');
    }
}
