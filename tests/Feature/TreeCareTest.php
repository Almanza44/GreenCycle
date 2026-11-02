<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tree;
use App\Models\SeedType;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Carbon;

class TreeCareTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_can_care_for_own_tree(): void
    {
        $user = User::factory()->create();

        $seedType = SeedType::factory()->create();

        $tree = Tree::factory()->create([
            'user_id' => $user->id,
            'seed_type_id' => $seedType->id,
            'progress' => 0,
            'health' => 80,
            'status' => 'ACTIVE',
            'next_care_at' => null,
        ]);

        Sanctum::actingAs($user);
        $id=$tree->id;
        // Petición HTTP POST al endpoint usando interpolación de cadenas
        $response = $this->postJson("/api/v1/trees/{$id}/care");
        $response->assertStatus(200);

        $this->assertDatabaseHas('trees', [
        'id' => $tree->id,
        'progress' => 1,
        'health' => 100,
        ]);

    }

    public function test_tree_cannot_be_cared_during_cooldown(): void
    {
        $user = User::factory()->create();
        $seedType = SeedType::factory()->create();

        $tree = Tree::factory()->create([
            'user_id' => $user->id,
            'seed_type_id' => $seedType->id,
            'progress' => 1,
            'health' => 100,
            'status' => 'ACTIVE',
            'next_care_at' => now()->addMinutes(60),
        ]);

        Sanctum::actingAs($user);

        $response = $this->postJson("/api/v1/trees/{$tree->id}/care");

        $response->assertStatus(409);

        $this->assertDatabaseHas('trees', [
            'id' => $tree->id,
            'progress' => 1,
        ]);
    }

    public function test_tree_levels_up_after_five_cares(): void
    {
        $user = User::factory()->create();
        $seedType = SeedType::factory()->create();

        $tree = Tree::factory()->create([
            'user_id' => $user->id,
            'seed_type_id' => $seedType->id,
            'level' => 0,
            'progress' => 0,
            'health' => 100,
            'status' => 'ACTIVE',
            'next_care_at' => null,
        ]);

        Sanctum::actingAs($user);

        $time = Carbon::parse('2026-11-02 10:00:00');
        Carbon::setTestNow($time);

        try {
            for ($i = 0; $i < 5; $i++) {
                $response = $this->postJson("/api/v1/trees/{$tree->id}/care");

                $response->assertStatus(200);

                $time = $time->copy()->addMinutes(61);
                Carbon::setTestNow($time);
            }

            $this->assertDatabaseHas('trees', [
                'id' => $tree->id,
                'level' => 1,
                'progress' => 0,
            ]);
        } finally {
            Carbon::setTestNow();
        }
    }

    public function test_tree_becomes_mature_at_level_ten(): void
    {
        $user = User::factory()->create();
        $seedType = SeedType::factory()->create();

        $tree = Tree::factory()->create([
            'user_id' => $user->id,
            'seed_type_id' => $seedType->id,
            'level' => 9,
            'progress' => 4,
            'health' => 100,
            'status' => 'ACTIVE',
            'next_care_at' => null,
        ]);

        Sanctum::actingAs($user);

        $response = $this->postJson("/api/v1/trees/{$tree->id}/care");

        $response->assertStatus(200);

        $this->assertDatabaseHas('trees', [
            'id' => $tree->id,
            'level' => 10,
            'progress' => 0,
            'status' => 'MATURE',
        ]);
    }

    public function test_user_cannot_care_for_another_users_tree(): void
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();

        $seedType = SeedType::factory()->create();

        $tree = Tree::factory()->create([
            'user_id' => $anotherUser->id,
            'seed_type_id' => $seedType->id,
            'progress' => 0,
            'health' => 100,
            'status' => 'ACTIVE',
            'next_care_at' => null,
        ]);

        Sanctum::actingAs($user);

        $response = $this->postJson("/api/v1/trees/{$tree->id}/care");

        $response->assertStatus(403);

        $this->assertDatabaseHas('trees', [
            'id' => $tree->id,
            'user_id' => $anotherUser->id,
            'progress' => 0,
        ]);
    }
}
