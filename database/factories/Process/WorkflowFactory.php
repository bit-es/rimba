<?php

namespace Database\Factories\Process;

use App\Models\Org\OrgTeam;
use App\Models\Process\WorkflowStep;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkflowFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'org_team_id' => OrgTeam::factory(),
            'start_step_id' => WorkflowStep::factory(),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'is_active' => fake()->boolean(),
            'attributes' => '{}',
        ];
    }
}
