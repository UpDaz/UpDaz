<?php

namespace Tests\Feature\Observers;

use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\ResponseCache\Facades\ResponseCache;
use Tests\TestCase;

class ReviewObserverTest extends TestCase
{
    use RefreshDatabase;

    public function testForgetsTheCachedPagesDisplayingReviewsWhenAReviewIsCreated(): void
    {
        ResponseCache::shouldReceive('forget')->once()->with([route('home'), route('webflow'), route('laravel'), route('ecommerce')]);

        Review::factory()->create();
    }

    public function testForgetsTheCachedPagesDisplayingReviewsWhenAReviewIsUpdated(): void
    {
        $review = Review::factory()->create();

        ResponseCache::shouldReceive('forget')->once()->with([route('home'), route('webflow'), route('laravel'), route('ecommerce')]);

        $review->update(['name' => 'Nom modifié']);
    }

    public function testForgetsTheCachedPagesDisplayingReviewsWhenAReviewIsDeleted(): void
    {
        $review = Review::factory()->create();

        ResponseCache::shouldReceive('forget')->once()->with([route('home'), route('webflow'), route('laravel'), route('ecommerce')]);

        $review->delete();
    }
}
