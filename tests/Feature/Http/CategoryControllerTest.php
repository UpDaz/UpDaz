<?php

namespace Tests\Feature\Http;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\Console\Kernel as ConsoleKernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Mockery;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = Mockery::mock(ConsoleKernel::class)->makePartial();
        $kernel->shouldReceive('call')->with('sitemap:generate')->zeroOrMoreTimes();
        Artisan::swap($kernel);
    }

    public function testActiveCategoryIsDisplayed(): void
    {
        $category = Category::factory()->create();

        $response = $this->get(route('category', ['slug' => $category->slug]));

        $response->assertOk();
    }

    public function testCategoryPageDisplaysABreadcrumbBackToTheBlog(): void
    {
        $category = Category::factory()->create(['name' => 'Laravel']);

        $response = $this->get(route('category', ['slug' => $category->slug]));

        $articlesUrl = route('articles');
        $categoryUrl = route('category', ['slug' => $category->slug]);

        $response->assertSeeInOrder([
            "<a href=\"{$articlesUrl}\" class=\"text-sm\">Articles</a>",
            "<a href=\"{$categoryUrl}\" class=\"text-sm\">Laravel</a>",
        ], false);
    }

    public function testCategoryTitleDoesNotRepeatTheBrand(): void
    {
        $category = Category::factory()->create(['meta_title' => 'Laravel : actualités | UpDaz']);

        $response = $this->get(route('category', ['slug' => $category->slug]));

        $response->assertSee('<title>Laravel : actualités | UpDaz</title>', false);
    }

    public function testUnknownCategorySlugRedirectsToBlog(): void
    {
        $response = $this->get(route('category', ['slug' => 'unknown-category']));

        $response->assertRedirect(route('articles'));
    }

    public function testInactiveCategoryRedirectsToBlog(): void
    {
        $category = Category::factory()->create(['is_active' => false]);

        $response = $this->get(route('category', ['slug' => $category->slug]));

        $response->assertRedirect(route('articles'));
    }

    public function testCategoryListsArticlesAttachedAsSecondaryCategory(): void
    {
        $mainCategory = Category::factory()->create();
        $secondaryCategory = Category::factory()->create();

        $article = Article::factory()->create([
            'category_id' => $mainCategory->id,
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);
        $article->categories()->attach($secondaryCategory);

        $response = $this->get(route('category', ['slug' => $secondaryCategory->slug]));

        $response->assertOk();
        $response->assertSee($article->title);
    }
}
