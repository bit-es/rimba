<?php

namespace Database\Factories\Support\Todo;

use App\Models\Support\Todo\TaskListTemplate;
use App\Models\Support\Todo\TaskListTemplateItem;
use App\Models\Support\Todo\TaskTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskListTemplateItemFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'task_list_template_id' => TaskListTemplate::factory(),
            'task_template_id' => TaskTemplate::factory(),
            'depends_on_id' => TaskListTemplateItem::factory(),
        ];
    }
}
