<?php

namespace Database\Factories\Business\Lms\Models;

use App\Models\Business\Lms\Models\Course;
use App\Models\Business\Lms\Models\CourseGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseGroupAssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'course_group_id' => CourseGroup::factory(),
            'attributes' => '{}',
        ];
    }
}
