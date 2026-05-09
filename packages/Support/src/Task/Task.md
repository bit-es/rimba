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
// MIGRATION: create_tasks_table.php
//-------------------------------------------
Schema::create('tasks', function (Blueprint $table) {
    $table->id();

    $table->string('title');
    $table->text('description')->nullable();

    $table->foreignId('role_id')->nullable()->constrained('roles');
    $table->foreignId('staff_id')->nullable();

    $table->foreignId('task_template_id')->nullable();

    $table->string('status')->default('pending');

    $table->string('completion_action')->nullable(); // direct override
    $table->json('payload')->nullable();

    $table->timestamps();
});


//-------------------------------------------
// MIGRATION: create_task_templates_table.php
//-------------------------------------------
Schema::create('task_templates', function (Blueprint $table) {
    $table->id();

    $table->string('title');
    $table->text('description')->nullable();

    $table->foreignId('role_id')->nullable()->constrained('roles');

    $table->string('completion_action')->nullable();
    $table->json('payload')->nullable();

    $table->timestamps();
});


//-------------------------------------------
// MIGRATION: create_taskables_table.php
//-------------------------------------------
Schema::create('taskables', function (Blueprint $table) {
    $table->id();

    $table->foreignId('task_id')->constrained()->cascadeOnDelete();

    $table->morphs('taskable');

    $table->string('relation_type')->nullable();

    $table->timestamps();
});


//-------------------------------------------
// MIGRATION: create_task_templateables_table.php
//-------------------------------------------
Schema::create('task_templateables', function (Blueprint $table) {
    $table->id();

    $table->foreignId('task_template_id')->constrained()->cascadeOnDelete();

    $table->morphs('task_templateable');

    $table->integer('order')->nullable();

    $table->timestamps();
});


//-------------------------------------------
// ENTITY: Task.php
//-------------------------------------------
namespace BitEs\Support\Task\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'role_id',
        'staff_id',
        'task_template_id',
        'status',
        'completion_action',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function template()
    {
        return $this->belongsTo(TaskTemplate::class, 'task_template_id');
    }
}


//-------------------------------------------
// ENTITY: TaskTemplate.php
//-------------------------------------------
namespace BitEs\Support\Task\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class TaskTemplate extends Model
{
    protected $fillable = [
        'title',
        'description',
        'role_id',
        'completion_action',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}


//-------------------------------------------
// TRAIT: HasTasks.php
//-------------------------------------------
namespace BitEs\Support\Task\Concerns;

use BitEs\Support\Task\Entities\Task;

trait HasTasks
{
    public function tasks()
    {
        return $this->morphToMany(Task::class, 'taskable')
            ->withPivot(['relation_type'])
            ->withTimestamps();
    }
}


//-------------------------------------------
// TRAIT: HasTaskTemplates.php
//-------------------------------------------
namespace BitEs\Support\Task\Concerns;

use BitEs\Support\Task\Entities\TaskTemplate;

trait HasTaskTemplates
{
    public function taskTemplates()
    {
        return $this->morphToMany(TaskTemplate::class, 'task_templateable')
            ->withPivot(['order'])
            ->orderBy('pivot_order');
    }
}


//-------------------------------------------
// SERVICE: TaskService.php
//-------------------------------------------
namespace BitEs\Support\Task\Services;

use BitEs\Support\Task\Entities\Task;
use BitEs\Support\Task\Entities\TaskTemplate;
use BitEs\Foundation\Access\Services\RoleResolver;

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