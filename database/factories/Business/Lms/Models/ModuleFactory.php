<?php

namespace Database\Factories\Business\Lms\Models;

use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'duration_minutes' => fake()->numberBetween(-10000, 10000),
            'validity_days' => fake()->numberBetween(-10000, 10000),
            'attributes' => '{}',
        ];
    }
}
