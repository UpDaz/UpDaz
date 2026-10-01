<?php

namespace Tests\Feature\Http;

use App\Models\Article;
use App\Models\Category;
use App\Models\Redirect;
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

    public function testArticlePageDisplaysABreadcrumbBackToItsMainCategory(): void
    {
        $mainCategory = Category::factory()->create(['name' => 'Laravel']);

        $article = Article::factory()->create([
            'category_id' => $mainCategory->id,
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);

        $response = $this->get(route('article', ['categorySlug' => $mainCategory->slug, 'slug' => $article->slug]));

        $articlesUrl = route('articles');
        $categoryUrl = route('category', ['slug' => $mainCategory->slug]);

        $response->assertSeeInOrder([
            "<a href=\"{$articlesUrl}\" class=\"text-sm\">Articles</a>",
            "<a href=\"{$categoryUrl}\" class=\"text-sm\">Laravel</a>",
        ], false);
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
        $this->assertSame('Matthieu DAZORD', $blogPosting['author']['name']);
        $this->assertSame(route('home') . '#matthieu-dazord', $blogPosting['author']['@id']);
        $this->assertSame('Organization', $blogPosting['publisher']['@type']);
        $this->assertStringNotContainsString('{{', json_encode($blogPosting));
        $response->assertSee('href="' . route('home') . '#presentation" rel="author"', false);

        $breadcrumb = collect($matches[1])
            ->map(fn (string $json): ?array => json_decode($json, true))
            ->firstWhere('@type', 'BreadcrumbList');

        $this->assertSame(
            ['Accueil', 'Articles', $category->name, $article->title],
            array_column($breadcrumb['itemListElement'], 'name')
        );
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

    public function testObsoleteArticleUrlIsPermanentlyRedirectedToItsRegisteredTarget(): void
    {
        Redirect::factory()->create([
            'from_path' => '/articles/laravel/ancien-article',
            'to_path' => '/articles/laravel/nouvel-article',
        ]);

        $response = $this->get('/articles/laravel/ancien-article');

        $response->assertStatus(301);
        $response->assertRedirect('/articles/laravel/nouvel-article');
    }

    public function testGoneArticleUrlAnswers410(): void
    {
        Redirect::factory()->gone()->create(['from_path' => '/articles/developpement/hors-sujet']);

        $response = $this->get('/articles/developpement/hors-sujet');

        $response->assertStatus(410);
    }

    public function testUnpublishedArticleWithARegisteredRedirectIsRedirected(): void
    {
        $category = Category::factory()->create();

        $article = Article::factory()->create([
            'category_id' => $category->id,
            'is_published' => false,
        ]);

        Redirect::factory()->create([
            'from_path' => "/articles/{$category->slug}/{$article->slug}",
            'to_path' => '/application-web-bordeaux',
        ]);

        $response = $this->get(route('article', ['categorySlug' => $category->slug, 'slug' => $article->slug]));

        $response->assertStatus(301);
        $response->assertRedirect('/application-web-bordeaux');
    }

    public function testUnknownArticleUrlWithoutRedirectStillFallsBackToTheBlog(): void
    {
        $response = $this->get('/articles/laravel/inconnu');

        $response->assertRedirect(route('articles'));
    }

    public function testOfflineArticleReachedThroughASecondaryCategoryFollowsItsCanonicalRedirect(): void
    {
        $mainCategory = Category::factory()->create(['slug' => 'laravel']);
        $secondaryCategory = Category::factory()->create(['slug' => 'developpement']);

        $article = Article::factory()->create([
            'slug' => 'retire',
            'category_id' => $mainCategory->id,
            'is_published' => false,
        ]);
        $article->categories()->attach($secondaryCategory);

        Redirect::factory()->gone()->create(['from_path' => '/articles/laravel/retire']);

        $response = $this->get('/articles/developpement/retire');

        $response->assertStatus(410);
    }
}
