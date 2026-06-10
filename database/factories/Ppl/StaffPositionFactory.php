<?php

namespace Database\Factories\Ppl;

use App\Models\Job\JobPosition;
use App\Models\Ppl\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffPositionFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'staff_id' => Staff::factory(),
            'job_position_id' => JobPosition::factory(),
            'assignment_type' => fake()->randomElement(["primary","secondary","acting"]),
            'status' => fake()->randomElement(["active","ended","pending"]),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'attributes' => '{}',
        ];
    }
}
