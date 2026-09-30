<?php

namespace Database\Factories;

use App\Models\Redirect;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Redirect>
 */
class RedirectFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'from_path' => '/articles/' . fake()->unique()->slug(),
            'to_path' => '/articles/' . fake()->slug(),
        ];
    }

    public function gone(): static
    {
        return $this->state(fn (): array => ['to_path' => null]);
    }
}
