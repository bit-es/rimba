<?php

namespace Database\Factories\Business\Lms\Models;

use App\Models\Business\Lms\Models\Course;
use App\Models\Business\Lms\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'module_id' => Module::factory(),
            'sequence' => fake()->numberBetween(-10000, 10000),
            'attributes' => '{}',
        ];
    }
}
