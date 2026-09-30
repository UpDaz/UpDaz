<?php

namespace App\Observers;

use App\Models\Review;
use Spatie\ResponseCache\Facades\ResponseCache;

class ReviewObserver
{
    public function saved(Review $review): void
    {
        $this->forgetPagesDisplayingReviews();
    }

    public function deleted(Review $review): void
    {
        $this->forgetPagesDisplayingReviews();
    }

    private function forgetPagesDisplayingReviews(): void
    {
        ResponseCache::forget([route('home'), route('laravel')]);
    }
}
