<?php

namespace Database\Factories\Support\Todo;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskListFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
        ];
    }
}
