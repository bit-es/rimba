<?php

namespace Database\Factories\Business\Lms\Models;

use App\Models\Org\OrgTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'org_team_id' => OrgTeam::factory(),
            'code' => fake()->word(),
            'title' => fake()->sentence(4),
            'description' => fake()->text(),
            'is_active' => fake()->boolean(),
            'attributes' => '{}',
        ];
    }
}
