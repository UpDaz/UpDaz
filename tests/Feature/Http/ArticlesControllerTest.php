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
}
