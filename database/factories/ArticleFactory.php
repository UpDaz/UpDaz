<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'content' => implode("\n\n", fake()->paragraphs(5)),
            'is_published' => false,
            'catch_phrase' => fake()->sentence(),
            'slug' => fake()->unique()->slug(),
            'published_at' => now(),
        ];
    }
}
