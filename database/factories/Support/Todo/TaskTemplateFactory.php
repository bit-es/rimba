<?php

namespace Database\Factories\Support\Todo;

use App\Models\Support\Todo\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskTemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'role_id' => Role::factory(),
            'name' => fake()->name(),
        ];
    }
}
