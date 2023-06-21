<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Route>
 */
class RouteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => fake()->unique()->randomNumber(),
            'name' => fake()->name,
            'from' => fake()->city,
            'to' => fake()->city,
            'distance' => fake()->randomFloat(2, 0, 1000),
            'time' => fake()->randomNumber(),
            //
        ];
    }
}
