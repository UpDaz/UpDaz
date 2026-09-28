<?php

namespace Tests\Feature\Http;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testActiveCategoryIsDisplayed(): void
    {
        $category = Category::factory()->create();

        $response = $this->get(route('category', ['slug' => $category->slug]));

        $response->assertOk();
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
}
