<?php

namespace Database\Factories\Process;

use App\Models\Ppl\Staff;
use App\Models\Process\WorkflowInstance;
use App\Models\Process\WorkflowStep;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkflowDecisionFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'workflow_instance_id' => WorkflowInstance::factory(),
            'workflow_step_id' => WorkflowStep::factory(),
            'user_id' => Staff::factory(),
            'decision' => fake()->randomElement(["approve","reject","request_changes"]),
            'comment' => fake()->text(),
            'decided_at' => fake()->dateTime(),
            'attributes' => '{}',
        ];
    }
}
