<?php

namespace Database\Factories\Business\Eam\Models;

use Illuminate\Database\Eloquent\Factories\Factory;

class AssetTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'attributes' => '{}',
        ];
    }
}
