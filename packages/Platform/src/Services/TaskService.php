<?php

declare(strict_types=1);

namespace Bites\Platform\Services;

use Bites\Platform\Entities\Task;
use Bites\Platform\Entities\TaskList;

class TaskService
{
    public function create($model, string $title, ?string $description, string $roleName, ?int $staffId = null): Task
    {
        $roleId = RoleResolver::resolveId($roleName);

        $task = Task::create([
            'title' => $title,
            'description' => $description,
            'role_id' => $roleId,
            'staff_id' => $staffId,
            'status' => 'pending',
        ]);

        $model->tasks()->attach($task->id, [
            'relation_type' => 'origin'
        ]);

        return $task;
    }

    public function createFromTemplate($model, TaskTemplate $template, ?int $staffId = null): Task
    {
        $task = Task::create([
            'title' => $template->title,
            'description' => $template->description,
            'role_id' => $template->role_id,
            'staff_id' => $staffId,
            'task_template_id' => $template->id,
            'completion_action' => $template->completion_action,
            'payload' => $template->payload,
        ]);

        $model->tasks()->attach($task->id, [
            'relation_type' => 'origin'
        ]);

        return $task;
    }
}