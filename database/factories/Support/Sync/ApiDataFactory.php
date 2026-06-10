<?php

namespace Database\Factories\Support\Sync;

use App\Models\Support\Sync\ApiConfig;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApiDataFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'api_config_id' => ApiConfig::factory(),
            'fingerprint' => fake()->word(),
            'payload' => '{}',
            'status' => fake()->word(),
            'processed_at' => fake()->dateTime(),
            'error' => fake()->text(),
        ];
    }
}
