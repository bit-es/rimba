<?php

namespace Database\Factories\Process;

use App\Models\Process\WorkflowInstance;
use App\Models\Process\WorkflowStep;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkflowInstanceStepFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'workflow_instance_id' => WorkflowInstance::factory(),
            'workflow_step_id' => WorkflowStep::factory(),
            'status' => fake()->randomElement(["pending","active","completed","skipped"]),
            'started_at' => fake()->dateTime(),
            'completed_at' => fake()->dateTime(),
            'attributes' => '{}',
        ];
    }
}
