<?php

namespace Database\Factories;

use App\Models\RawArticle;
use App\Models\WeeklyDigest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WeeklyDigest>
 */
class WeeklyDigestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'week_start' => fake()->dateTimeBetween('-2 months')->format('Y-m-d'),
            'theme' => fake()->words(3, true),
            'summary' => fake()->paragraph(),
            'raw_article_ids' => RawArticle::factory()->count(3)->create()->pluck('id')->toArray(),
            'post_id' => null,
        ];
    }
}
