<?php

namespace Database\Factories\Business\Hrm\Models;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobTitleFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'jobgrade' => fake()->word(),
            'uuid' => fake()->uuid(),
            'description' => fake()->text(),
            'attributes' => '{}',
            'masco_code' => fake()->word(),
        ];
    }
}
