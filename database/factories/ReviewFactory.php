<?php

namespace Database\Factories;

use App\Enums\ReviewPlatform;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'reviewed_at' => fake()->dateTimeBetween('-2 years')->format('Y-m-01'),
            'platform' => fake()->randomElement(ReviewPlatform::cases()),
            'rating' => fake()->numberBetween(1, 5),
            'content' => fake()->paragraph(),
        ];
    }
}
