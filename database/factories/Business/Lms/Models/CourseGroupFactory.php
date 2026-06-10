<?php

namespace Database\Factories\Business\Lms\Models;

use App\Models\Business\Lms\Models\CourseGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'parent_id' => CourseGroup::factory(),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'attributes' => '{}',
        ];
    }
}
