<?php

namespace Database\Factories\Business\Eam\Models;

use App\Models\Business\Eam\Models\Asset;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetAssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'asset_id' => Asset::factory(),
            'type' => fake()->randomElement(["primary","secondary","temporary"]),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'attributes' => '{}',
        ];
    }
}
