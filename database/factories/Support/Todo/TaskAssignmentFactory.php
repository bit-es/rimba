<?php

namespace Database\Factories\Support\Todo;

use App\Models\Ppl\Staff;
use App\Models\Support\Todo\Role;
use App\Models\Support\Todo\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskAssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'task_id' => Task::factory(),
            'role_id' => Role::factory(),
            'staff_id' => Staff::factory(),
            'assigned_by' => Staff::factory()->create()->assigned_by,
        ];
    }
}
