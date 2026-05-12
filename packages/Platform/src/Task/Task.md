<?php

//-------------------------------------------
// CONFIG: config/task.php
//-------------------------------------------
return [
    'models' => [
        'task' => \BitEs\Support\Task\Entities\Task::class,
        'task_template' => \BitEs\Support\Task\Entities\TaskTemplate::class,
    ],

    'actions' => [
        // 'approve_request' => \App\Actions\ApproveRequest::class,
    ],
];




//-------------------------------------------
// ENTITY: Task.php
//-------------------------------------------
namespace BitEs\Support\Task\Entities;




//-------------------------------------------
// ENTITY: TaskTemplate.php
//-------------------------------------------
namespace BitEs\Support\Task\Entities;








//-------------------------------------------
// SERVICE: TaskService.php
//-------------------------------------------
namespace BitEs\Support\Task\Services;




//-------------------------------------------
// SERVICE: TaskActionRegistry.php
//-------------------------------------------
namespace BitEs\Support\Task\Services;

use BitEs\Support\Task\Entities\Task;

class TaskActionRegistry
{
    public static function run(Task $task)
    {
        $map = config('task.actions');

        $actionKey = $task->completion_action
            ?? $task->template?->completion_action;

        if (!$actionKey || !isset($map[$actionKey])) {
            return;
        }

        app($map[$actionKey])->execute($task);
    }
}


//-------------------------------------------
// ACTION: CreateTaskFromTemplate.php
//-------------------------------------------
namespace BitEs\Support\Task\Actions;

use BitEs\Support\Task\Services\TaskService;
use BitEs\Support\Task\Entities\TaskTemplate;

class CreateTaskFromTemplate
{
    public function execute($model, TaskTemplate $template)
    {
        return app(TaskService::class)
            ->createFromTemplate($model, $template);
    }
}


//-------------------------------------------
// ACTION: CompleteTask.php
//-------------------------------------------
namespace BitEs\Support\Task\Actions;

use BitEs\Support\Task\Entities\Task;
use BitEs\Support\Task\Services\TaskActionRegistry;

class CompleteTask
{
    public function execute(Task $task)
    {
        $task->update([
            'status' => 'completed'
        ]);

        TaskActionRegistry::run($task);
    }
}


//-------------------------------------------
// FOUNDATION SERVICE (REFERENCE): RoleResolver.php
//-------------------------------------------
namespace BitEs\Foundation\Access\Services;

use Spatie\Permission\Models\Role;

class RoleResolver
{
    public static function resolveId(string $roleName): ?int
    {
        return Role::where('name', $roleName)->value('id');
    }
}