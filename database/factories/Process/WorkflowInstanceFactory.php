<?php

namespace Database\Factories\Process;

use App\Models\Process\Workflow;
use App\Models\Process\WorkflowStep;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkflowInstanceFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'workflow_id' => Workflow::factory(),
            'current_step_id' => WorkflowStep::factory(),
            'status' => fake()->randomElement(["active","completed","cancelled"]),
            'started_at' => fake()->dateTime(),
            'completed_at' => fake()->dateTime(),
            'attributes' => '{}',
        ];
    }
}
