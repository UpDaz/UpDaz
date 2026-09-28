<?php

namespace Tests\Feature\Http;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\Console\Kernel as ConsoleKernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Mockery;
use Tests\TestCase;

class ArticlesControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = Mockery::mock(ConsoleKernel::class)->makePartial();
        $kernel->shouldReceive('call')->with('sitemap:generate')->zeroOrMoreTimes();
        Artisan::swap($kernel);
    }

    public function testArticleIsDisplayedUnderItsMainCategory(): void
    {
        $mainCategory = Category::factory()->create();

        $article = Article::factory()->create([
            'category_id' => $mainCategory->id,
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);

        $response = $this->get(route('article', ['categorySlug' => $mainCategory->slug, 'slug' => $article->slug]));

        $response->assertOk();
    }

    public function testArticleUnderASecondaryCategoryRedirectsToItsCanonicalUrl(): void
    {
        $mainCategory = Category::factory()->create();
        $secondaryCategory = Category::factory()->create();

        $article = Article::factory()->create([
            'category_id' => $mainCategory->id,
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);
        $article->categories()->attach($secondaryCategory);

        $response = $this->get(route('article', ['categorySlug' => $secondaryCategory->slug, 'slug' => $article->slug]));

        $response->assertRedirect(route('article', ['categorySlug' => $mainCategory->slug, 'slug' => $article->slug]));
        $response->assertStatus(301);
    }

    public function testArticleUnderAnUnrelatedCategoryRedirectsToBlog(): void
    {
        $mainCategory = Category::factory()->create();
        $unrelatedCategory = Category::factory()->create();

        $article = Article::factory()->create([
            'category_id' => $mainCategory->id,
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);

        $response = $this->get(route('article', ['categorySlug' => $unrelatedCategory->slug, 'slug' => $article->slug]));

        $response->assertRedirect(route('articles'));
    }

    public function testArticlePageRendersValidBlogPostingStructuredData(): void
    {
        $category = Category::factory()->create();

        $article = Article::factory()->create([
            'title' => 'Laravel face aux défis de la scalabilité',
            'category_id' => $category->id,
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);

        $response = $this->get(route('article', ['categorySlug' => $category->slug, 'slug' => $article->slug]));

        preg_match_all('#<script type="application/ld\+json">(.*?)</script>#s', $response->getContent(), $matches);

        $blogPosting = collect($matches[1])
            ->map(fn (string $json): ?array => json_decode($json, true))
            ->firstWhere('@type', 'BlogPosting');

        $this->assertNotNull($blogPosting);
        $this->assertSame('Laravel face aux défis de la scalabilité', $blogPosting['headline']);
        $this->assertSame($article->published_at->toIso8601String(), $blogPosting['datePublished']);
        $this->assertSame('Person', $blogPosting['author']['@type']);
        $this->assertSame('Organization', $blogPosting['publisher']['@type']);
        $this->assertStringNotContainsString('{{', json_encode($blogPosting));
    }

    public function testRelatedArticlesOnlyListReadableArticles(): void
    {
        $category = Category::factory()->create();

        $article = Article::factory()->create([
            'category_id' => $category->id,
            'is_published' => true,
            'published_at' => now()->subDays(2),
        ]);

        $readableArticle = Article::factory()->create([
            'category_id' => $category->id,
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);

        $scheduledArticle = Article::factory()->create([
            'category_id' => $category->id,
            'is_published' => true,
            'published_at' => now()->addDays(2),
        ]);

        $draftArticle = Article::factory()->create([
            'category_id' => $category->id,
            'is_published' => false,
            'published_at' => now()->subDay(),
        ]);

        $response = $this->get(route('article', ['categorySlug' => $category->slug, 'slug' => $article->slug]));

        $response->assertSee($readableArticle->slug);
        $response->assertDontSee($scheduledArticle->slug);
        $response->assertDontSee($draftArticle->slug);
    }
}
