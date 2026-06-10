<?php

namespace Database\Factories\Support\Sync;

use Illuminate\Database\Eloquent\Factories\Factory;

class ApiConfigFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'source_type' => fake()->word(),
            'source_config' => '{}',
            'data_path' => fake()->word(),
            'depends_on' => '{}',
            'mapping' => '{}',
            'active' => fake()->boolean(),
        ];
    }
}
