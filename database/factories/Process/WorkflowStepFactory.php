<?php

namespace Database\Factories\Process;

use App\Models\Process\Workflow;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkflowStepFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'workflow_id' => Workflow::factory(),
            'type' => fake()->randomElement(["start","process","decision","end"]),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'requires_tasks' => fake()->boolean(),
            'requires_decision' => fake()->boolean(),
            'is_automatic' => fake()->boolean(),
            'attributes' => '{}',
        ];
    }
}
