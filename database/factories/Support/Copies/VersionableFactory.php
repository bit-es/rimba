<?php

namespace Database\Factories\Support\Copies;

use App\Models\Support\Copies\Version;
use Illuminate\Database\Eloquent\Factories\Factory;

class VersionableFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(["document","workflow","template","service","config","other"]),
            'name' => fake()->name(),
            'current_version_id' => Version::factory(),
            'attributes' => '{}',
        ];
    }
}
