<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(mt_rand(2, 3)),
            'announcement' => fake()->sentence(),
            'text' => fake()->paragraphs(3, true),
            'tags' => fake()->words(mt_rand(1, 4), true),
            'date' => fake()->dateTimeThisYear(),
        ];
    }
}