<?php

namespace Database\Factories;

use App\Models\SeedType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SeedType>
 */
class SeedTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'name' => fake()->unique()->word(),
        'care_needed_per_level' => 5,
        'reward_coins' => 10,
    ];
}
}
