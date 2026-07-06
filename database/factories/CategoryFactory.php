<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'name' => $name,
            'is_active' => true,
            'slug' => str($name)->slug(),
            'catch_phrase' => fake()->sentence(),
            'meta_title' => fake()->sentence(4),
            'meta_description' => fake()->sentence(10),
        ];
    }
}
