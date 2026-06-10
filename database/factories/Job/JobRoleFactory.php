<?php

namespace Database\Factories\Job;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(["approval","operation","admin","reporting"]),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'attributes' => '{}',
        ];
    }
}
