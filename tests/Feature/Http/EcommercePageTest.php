<?php

namespace Tests\Feature\Http;

use App\Enums\ReviewPlatform;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EcommercePageTest extends TestCase
{
    use RefreshDatabase;

    public function testEcommercePageIsServedUnderTheWebApplicationPage(): void
    {
        $this->assertSame(
            url('/application-web-bordeaux/e-commerce-sur-mesure'),
            route('ecommerce')
        );

        $response = $this->get(route('ecommerce'));

        $response->assertOk();
        $response->assertSee('Création de site e-commerce sur mesure à');
        $response->assertSee('PadelReference');
    }

    public function testFormerUrlsRedirectPermanentlyToTheEcommercePage(): void
    {
        $this->get('/sur-mesure/e-commerce-bordeaux')
            ->assertStatus(301)
            ->assertRedirect('/application-web-bordeaux/e-commerce-sur-mesure');

        $this->get('/prestashop')
            ->assertStatus(301)
            ->assertRedirect('/application-web-bordeaux/e-commerce-sur-mesure');
    }

    public function testBreadcrumbDeclaresTheWebApplicationPageAsParent(): void
    {
        $response = $this->get(route('ecommerce'));

        $response->assertSeeInOrder([
            '"position": 2',
            '"item": "' . route('laravel') . '"',
            '"position": 3',
            '"item": "' . route('ecommerce') . '"',
        ], false);
    }

    public function testCaseStudyReviewIsDisplayedOnTheEcommercePage(): void
    {
        Review::factory()->create([
            'name' => 'Maxime S.',
            'platform' => ReviewPlatform::Google,
            'reviewed_at' => '2026-09-01',
            'content' => 'Avis du client e-commerce',
        ]);

        $response = $this->get(route('ecommerce'));

        $response->assertSeeInOrder(['Maxime S.', 'sept. 2026', 'Avis du client e-commerce']);
    }

    public function testEcommercePageIsDisplayedWithoutTheCaseStudyReview(): void
    {
        Review::query()->where('name', 'Maxime S.')->delete();

        $response = $this->get(route('ecommerce'));

        $response->assertOk();
        $response->assertDontSee('Maxime S.');
    }
}
