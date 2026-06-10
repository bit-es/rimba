<?php

namespace Database\Factories\Org;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrgCorpFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'code' => fake()->word(),
            'type' => fake()->randomElement(["company","government","vendor","institution"]),
            'attributes' => '{}',
        ];
    }
}
