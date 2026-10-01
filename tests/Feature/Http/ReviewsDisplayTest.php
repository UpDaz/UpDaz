<?php

namespace Tests\Feature\Http;

use App\Enums\ReviewPlatform;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewsDisplayTest extends TestCase
{
    use RefreshDatabase;

    public function testConfiguredRatingAndReviewCountAreDisplayed(): void
    {
        config([
            'custom.reviews.google' => [
                'rating' => 4.9,
                'count' => 12,
                'url' => 'https://g.page/updaz',
            ],
        ]);

        $response = $this->get(route('home'));

        $response->assertSee('4,9 · 12 avis');
        $response->assertSee('href="https://g.page/updaz"', false);
    }

    public function testOnlyStarsAreDisplayedWhenNoRatingIsConfigured(): void
    {
        config(['custom.reviews.malt.rating' => null, 'custom.reviews.malt.count' => null]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('title="Avis clients sur Malt"', false);
    }

    public function testExistingReviewsAreImported(): void
    {
        $response = $this->get(route('home'));

        $response->assertSeeInOrder(['Linda R', 'nov. 2025', 'Amélie D.', 'David', 'Remy G.', 'Carla', 'juin 2023']);
    }

    public function testReviewsAreDisplayedMostRecentFirst(): void
    {
        Review::query()->delete();

        Review::factory()->create(['name' => 'Ancien client', 'reviewed_at' => '2024-03-01']);
        Review::factory()->create([
            'name' => 'Nouveau client',
            'reviewed_at' => '2026-08-01',
            'platform' => ReviewPlatform::Malt,
            'content' => "Première ligne\n<b>Seconde ligne</b>",
        ]);

        $response = $this->get(route('home'));

        $response->assertSeeInOrder(['Nouveau client', 'août 2026', 'Ancien client', 'mars 2024']);
        $response->assertSee('Première ligne<br />', false);
        $response->assertSee('&lt;b&gt;Seconde ligne&lt;/b&gt;', false);
        $response->assertSee('alt="malt"', false);
    }

    public function testCaseStudyReviewIsDisplayedOnTheLaravelPage(): void
    {
        Review::query()->where('name', 'David')->update(['content' => 'Avis mis à jour depuis l\'admin']);

        $response = $this->get(route('laravel'));

        $response->assertSeeInOrder(['David', 'sept. 2025', 'Avis mis à jour depuis l&#039;admin'], false);
    }

    public function testLaravelPageIsDisplayedWithoutTheCaseStudyReview(): void
    {
        Review::query()->where('name', 'David')->delete();

        $response = $this->get(route('laravel'));

        $response->assertOk();
        $response->assertDontSee('sept. 2025');
    }
}
