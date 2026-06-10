<?php

namespace Database\Factories\Business\Lms\Models;

use App\Models\Business\Lms\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'module_id' => Module::factory(),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'pass_score' => fake()->numberBetween(-10000, 10000),
            'attributes' => '{}',
        ];
    }
}
