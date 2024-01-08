<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 150),
            'user_id' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->text,
            'rating' => $this->faker->numberBetween(1, 5),
            'status' => 1,
        ];
    }
}
