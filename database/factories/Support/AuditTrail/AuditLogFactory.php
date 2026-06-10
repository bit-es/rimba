<?php

namespace Database\Factories\Support\AuditTrail;

use App\Models\Ppl\Staff;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuditLogFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'staff_id' => Staff::factory(),
            'result' => fake()->word(),
            'actor' => fake()->word(),
            'action' => fake()->word(),
            'reason' => fake()->word(),
            'metadata' => '{}',
        ];
    }
}
