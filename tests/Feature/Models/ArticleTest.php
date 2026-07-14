<?php

namespace Tests\Feature\Models;

use App\Models\Article;
use App\Models\Category;
use App\Models\WeeklyDigest;
use Illuminate\Contracts\Console\Kernel as ConsoleKernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Mockery;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Prevents the ArticleObserver's real sitemap:generate call (see
        // ArticleObserverTest) from writing files during these unrelated
        // model tests. RefreshDatabase already cached the facade's kernel
        // instance by this point, so swap() is required, not partialMock().
        $kernel = Mockery::mock(ConsoleKernel::class)->makePartial();
        $kernel->shouldReceive('call')->with('sitemap:generate')->zeroOrMoreTimes();
        Artisan::swap($kernel);
    }

    public function testFrontendUrlIsThePublicRouteWhenPublishedAndCategorized(): void
    {
        $category = Category::factory()->create(['slug' => 'intelligence-artificielle']);

        $article = Article::factory()->create([
            'slug' => 'mon-article',
            'category_id' => $category->id,
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);

        $this->assertSame(
            route('article', ['categorySlug' => 'intelligence-artificielle', 'slug' => 'mon-article']),
            $article->frontendUrl()
        );
    }

    public function testFrontendUrlIsASignedPreviewLinkWhenNotPublished(): void
    {
        $category = Category::factory()->create();

        $article = Article::factory()->create([
            'category_id' => $category->id,
            'is_published' => false,
        ]);

        $url = $article->frontendUrl();

        $this->assertStringContainsString('/articles/preview/' . $article->id, $url);
        $this->assertStringContainsString('signature=', $url);
    }

    public function testFrontendUrlIsASignedPreviewLinkWhenPublishedButNotYetDue(): void
    {
        $category = Category::factory()->create();

        $article = Article::factory()->create([
            'category_id' => $category->id,
            'is_published' => true,
            'published_at' => now()->addWeek(),
        ]);

        $this->assertStringContainsString('/articles/preview/' . $article->id, $article->frontendUrl());
    }

    public function testFrontendUrlIsASignedPreviewLinkWhenPublishedWithoutACategory(): void
    {
        $article = Article::factory()->create([
            'category_id' => null,
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);

        $this->assertStringContainsString('/articles/preview/' . $article->id, $article->frontendUrl());
    }

    public function testDeletingAnArticleNullsTheLinkedWeeklyDigestInsteadOfFailing(): void
    {
        $article = Article::factory()->create();
        $digest = WeeklyDigest::factory()->create(['post_id' => $article->id]);

        $article->delete();

        $this->assertModelMissing($article);
        $this->assertNull($digest->fresh()->post_id);
    }
}
