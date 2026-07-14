<?php

namespace Tests\Feature\Observers;

use App\Models\Article;
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
