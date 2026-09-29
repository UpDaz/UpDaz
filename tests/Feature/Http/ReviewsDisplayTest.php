<?php

namespace Tests\Feature\Http;

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
}
