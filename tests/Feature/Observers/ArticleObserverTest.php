<?php

namespace Tests\Feature\Observers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Redirect;
use Illuminate\Contracts\Console\Kernel as ConsoleKernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Mockery;
use Tests\TestCase;

class ArticleObserverTest extends TestCase
{
    use RefreshDatabase;

    public function testRegeneratesTheSitemapWhenAnArticleIsCreatedAlreadyPublished(): void
    {
        $this->expectSitemapRegeneration();

        Article::factory()->create(['is_published' => true]);
    }

    public function testRegeneratesTheSitemapWhenAnArticleGetsPublished(): void
    {
        $article = Article::factory()->create(['is_published' => false]);

        $this->expectSitemapRegeneration();

        $article->update(['is_published' => true]);
    }

    public function testDoesNotRegenerateTheSitemapWhenCreatingAnUnpublishedArticle(): void
    {
        $this->expectNoSitemapRegeneration();

        Article::factory()->create(['is_published' => false]);
    }

    public function testDoesNotRegenerateTheSitemapWhenUpdatingAnUnrelatedField(): void
    {
        $article = Article::factory()->create(['is_published' => true]);

        $this->expectNoSitemapRegeneration();

        $article->update(['title' => 'Nouveau titre']);
    }

    public function testRegeneratesTheSitemapWhenAnArticleGetsUnpublished(): void
    {
        $article = Article::factory()->create(['is_published' => true]);

        $this->expectSitemapRegeneration();

        $article->update(['is_published' => false]);
    }

    public function testRedirectsTheOldUrlWhenAReadableArticleChangesSlug(): void
    {
        $this->allowSitemapRegeneration();

        $category = Category::factory()->create(['slug' => 'laravel']);
        $article = Article::factory()->create([
            'slug' => 'ancien-slug',
            'category_id' => $category->id,
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);

        $article->update(['slug' => 'nouveau-slug']);

        $this->assertSame('/articles/laravel/nouveau-slug', Redirect::findForPath('/articles/laravel/ancien-slug')->to_path);
    }

    public function testRedirectsTheOldUrlWhenAReadableArticleChangesMainCategory(): void
    {
        $this->allowSitemapRegeneration();

        $oldCategory = Category::factory()->create(['slug' => 'developpement']);
        $newCategory = Category::factory()->create(['slug' => 'laravel']);
        $article = Article::factory()->create([
            'slug' => 'mon-article',
            'category_id' => $oldCategory->id,
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);

        $article->update(['category_id' => $newCategory->id]);

        $this->assertSame('/articles/laravel/mon-article', Redirect::findForPath('/articles/developpement/mon-article')->to_path);
    }

    public function testDoesNotRedirectWhenADraftChangesSlug(): void
    {
        $this->allowSitemapRegeneration();

        $category = Category::factory()->create(['slug' => 'laravel']);
        $article = Article::factory()->create([
            'slug' => 'brouillon',
            'category_id' => $category->id,
            'is_published' => false,
        ]);

        $article->update(['slug' => 'brouillon-renomme']);

        $this->assertSame(0, Redirect::query()->count());
    }

    public function testForgetsTheRedirectOfAnArticleServedAgainAtItsUrl(): void
    {
        $this->allowSitemapRegeneration();

        $category = Category::factory()->create(['slug' => 'laravel']);
        $article = Article::factory()->create([
            'slug' => 'republie',
            'category_id' => $category->id,
            'is_published' => false,
            'published_at' => now()->subDay(),
        ]);
        Redirect::factory()->gone()->create(['from_path' => '/articles/laravel/republie']);

        $article->update(['is_published' => true]);

        $this->assertNull(Redirect::findForPath('/articles/laravel/republie'));
    }

    private function allowSitemapRegeneration(): void
    {
        $kernel = Mockery::mock(ConsoleKernel::class)->makePartial();
        $kernel->shouldReceive('call')->with('sitemap:generate')->zeroOrMoreTimes();

        Artisan::swap($kernel);
    }

    /**
     * RefreshDatabase migrates via Artisan::call('migrate') during setUp,
     * which caches the facade's resolved kernel instance. Rebinding the
     * container alone (partialMock) doesn't reach that cache, so the mock
     * must be installed via Artisan::swap() to actually intercept calls.
     */
    private function expectSitemapRegeneration(): void
    {
        $kernel = Mockery::mock(ConsoleKernel::class)->makePartial();
        $kernel->shouldReceive('call')->once()->with('sitemap:generate');

        Artisan::swap($kernel);
    }

    private function expectNoSitemapRegeneration(): void
    {
        $kernel = Mockery::mock(ConsoleKernel::class)->makePartial();
        $kernel->shouldNotReceive('call')->with('sitemap:generate');

        Artisan::swap($kernel);
    }
}
