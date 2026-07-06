<?php

namespace Tests\Feature\Models;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

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
}
