<?php

namespace Tests\Feature\Console;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenerateSitemapTest extends TestCase
{
    use RefreshDatabase;

    public function testGeneratesASitemapWithStaticAndDynamicUrls(): void
    {
        $category = Category::factory()->create(['slug' => 'e-commerce', 'is_active' => true]);
        $inactiveCategory = Category::factory()->create(['slug' => 'inactif', 'is_active' => false]);

        $publishedArticle = Article::factory()->create([
            'slug' => 'mon-article',
            'is_published' => true,
            'category_id' => $category->id,
        ]);

        $draftArticle = Article::factory()->create([
            'slug' => 'brouillon',
            'is_published' => false,
            'category_id' => $category->id,
        ]);

        $this->artisan('sitemap:generate')->assertExitCode(0);

        $sitemap = file_get_contents(public_path('sitemap.xml'));

        $this->assertStringContainsString(route('home'), $sitemap);
        $this->assertStringContainsString(route('legal-notices'), $sitemap);
        $this->assertStringContainsString(
            route('article', ['categorySlug' => $category->slug, 'slug' => $publishedArticle->slug]),
            $sitemap
        );
        $this->assertStringContainsString(route('category', ['slug' => $category->slug]), $sitemap);

        $this->assertStringNotContainsString(
            route('article', ['categorySlug' => $category->slug, 'slug' => $draftArticle->slug]),
            $sitemap
        );
        $this->assertStringNotContainsString(route('category', ['slug' => $inactiveCategory->slug]), $sitemap);

        unlink(public_path('sitemap.xml'));
    }
}
