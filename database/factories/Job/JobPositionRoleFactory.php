<?php

namespace Database\Factories\Job;

use App\Models\Job\JobPosition;
use App\Models\Job\JobRole;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobPositionRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'job_position_id' => JobPosition::factory(),
            'job_role_id' => JobRole::factory(),
        ];
    }
}
