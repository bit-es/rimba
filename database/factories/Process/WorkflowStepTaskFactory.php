<?php

namespace Database\Factories\Process;

use App\Models\Process\WorkflowStep;
use App\Models\Support\Todo\TaskListTemplate;
use App\Models\Support\Todo\TaskTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkflowStepTaskFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'workflow_step_id' => WorkflowStep::factory(),
            'task_template_id' => TaskTemplate::factory(),
            'task_list_template_id' => TaskListTemplate::factory(),
            'is_required' => fake()->boolean(),
            'attributes' => '{}',
        ];
    }
}
