<?php

namespace Database\Factories;

use App\Models\RawArticle;
use App\Models\Source;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RawArticle>
 */
class RawArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'source_id' => Source::factory(),
            'title' => fake()->sentence(),
            'url' => fake()->unique()->url(),
            'content' => fake()->paragraphs(5, true),
            'published_at' => fake()->dateTimeBetween('-1 month'),
            'theme' => null,
            'summary' => null,
            'keywords' => null,
            'analyzed_at' => null,
        ];
    }

    public function analyzed(): static
    {
        return $this->state(fn (array $attributes): array => [
            'theme' => fake()->words(2, true),
            'summary' => fake()->paragraph(),
            'keywords' => fake()->words(5),
            'analyzed_at' => now(),
        ]);
    }
}
