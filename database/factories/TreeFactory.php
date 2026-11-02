<?php

namespace Database\Factories;

use App\Models\Tree;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\SeedType;

/**
 * @extends Factory<Tree>
 */
class TreeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'user_id' => User::factory(),
        'seed_type_id' => SeedType::factory(),
        'name' => fake()->word(),
        'level' => 0,
        'health' => 100,
        'progress' => 0,
        'status' => 'ACTIVE',
        'next_care_at' => null,
        'last_deterioration_at' => null,
        'last_care_at' => null,
        'harvested_at' => null,
    ];
}
}
