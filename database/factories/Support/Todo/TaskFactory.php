<?php

namespace Database\Factories\Support\Todo;

use App\Models\Ppl\Staff;
use App\Models\Support\Todo\Role;
use App\Models\Support\Todo\TaskList;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'role_id' => Role::factory(),
            'staff_id' => Staff::factory(),
            'task_list_id' => TaskList::factory(),
            'title' => fake()->sentence(4),
            'description' => fake()->text(),
        ];
    }
}
