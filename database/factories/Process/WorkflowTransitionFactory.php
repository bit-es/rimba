<?php

namespace Database\Factories\Process;

use App\Models\Process\Workflow;
use App\Models\Process\WorkflowStep;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkflowTransitionFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'workflow_id' => Workflow::factory(),
            'from_step_id' => WorkflowStep::factory(),
            'to_step_id' => WorkflowStep::factory(),
            'name' => fake()->name(),
            'conditions' => '{}',
            'requires_approval' => fake()->boolean(),
            'attributes' => '{}',
        ];
    }
}
