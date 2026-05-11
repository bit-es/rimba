############################################

# CREATE PROJECT

############################################



composer create-project laravel/laravel faros-workflow-engine

cd faros-workflow-engine



composer require filament/filament:^5.0 spatie/laravel-permission:^7.0



############################################

# CREATE PACKAGE STRUCTURE

############################################



mkdir -p packages/faros/workflow/src/{Models,Services,Contracts,Actions,Resolvers,Filament,Facades}

mkdir -p packages/faros/workflow/database/migrations



############################################

# ROOT COMPOSER AUTOLOAD

############################################



# Add to composer.json manually under "autoload":

# "Faros\\Workflow\\": "packages/faros/workflow/src/"



composer dump-autoload



############################################

# SERVICE PROVIDER

############################################



cat > packages/faros/workflow/src/WorkflowServiceProvider.php <<'PHP'

<?php



namespace Faros\Workflow;



use Illuminate\Support\ServiceProvider;

use Faros\Workflow\Services\WorkflowEngine;



class WorkflowServiceProvider extends ServiceProvider

{

    public function register()

    {

        $this->app->singleton('workflow', function () {

            return new WorkflowEngine();

        });

    }

}

PHP



############################################

# FACADE

############################################



cat > packages/faros/workflow/src/Facades/Workflow.php <<'PHP'

<?php



namespace Faros\Workflow\Facades;



use Illuminate\Support\Facades\Facade;



class Workflow extends Facade

{

    protected static function getFacadeAccessor()

    {

        return 'workflow';

    }

}

PHP



############################################

# MODELS

############################################



cat > packages/faros/workflow/src/Models/Workflow.php <<'PHP'

<?php



namespace Faros\Workflow\Models;



use Illuminate\Database\Eloquent\Model;



class Workflow extends Model

{

    protected $fillable = ['code','version','definition'];



    protected $casts = [

        'definition' => 'array'

    ];

}

PHP



cat > packages/faros/workflow/src/Models/WorkflowInstance.php <<'PHP'

<?php



namespace Faros\Workflow\Models;



use Illuminate\Database\Eloquent\Model;



class WorkflowInstance extends Model

{

    protected $fillable = [

        'workflow_code',

        'workflow_version',

        'current_step',

        'status',

        'data'

    ];



    protected $casts = [

        'data' => 'array'

    ];



    public function tasks()

    {

        return $this->hasMany(WorkflowTask::class);

    }

}

PHP



cat > packages/faros/workflow/src/Models/WorkflowTask.php <<'PHP'

<?php



namespace Faros\Workflow\Models;



use Illuminate\Database\Eloquent\Model;



class WorkflowTask extends Model

{

    protected $fillable = [

        'workflow_instance_id',

        'step_key',

        'status',

        'payload'

    ];



    protected $casts = [

        'payload' => 'array'

    ];



    public function instance()

    {

        return $this->belongsTo(WorkflowInstance::class);

    }

}

PHP



cat > packages/faros/workflow/src/Models/WorkflowLog.php <<'PHP'

<?php



namespace Faros\Workflow\Models;



use Illuminate\Database\Eloquent\Model;



class WorkflowLog extends Model

{

    protected $fillable = [

        'workflow_instance_id',

        'step',

        'event',

        'data'

    ];



    protected $casts = [

        'data' => 'array'

    ];

}

PHP



############################################

# CONTRACT

############################################



cat > packages/faros/workflow/src/Contracts/WorkflowAction.php <<'PHP'

<?php



namespace Faros\Workflow\Contracts;



use Faros\Workflow\Models\WorkflowInstance;



interface WorkflowAction

{

    public function execute(WorkflowInstance $instance): void;

}

PHP



############################################

# TRANSITION COMPILER

############################################



cat > packages/faros/workflow/src/Services/TransitionCompiler.php <<'PHP'

<?php



namespace Faros\Workflow\Services;



class TransitionCompiler

{

    public static function compile(array $transitions): array

    {

        $map = [];



        foreach ($transitions as [$from, $on, $to]) {

            $map[$from][$on] = $to;

        }



        return $map;

    }

}

PHP



############################################

# WORKFLOW ENGINE

############################################



cat > packages/faros/workflow/src/Services/WorkflowEngine.php <<'PHP'

<?php



namespace Faros\Workflow\Services;



use Faros\Workflow\Models\Workflow;

use Faros\Workflow\Models\WorkflowInstance;

use Faros\Workflow\Models\WorkflowTask;

use Faros\Workflow\Contracts\WorkflowAction;



class WorkflowEngine

{

    public function start(string $code, array $payload = [])

    {

        $workflow = Workflow::where('code', $code)->latest()->first();

        $definition = $workflow->definition;



        $instance = WorkflowInstance::create([

            'workflow_code' => $code,

            'workflow_version' => $workflow->version,

            'current_step' => $definition['start'],

            'status' => 'running',

            'data' => $payload

        ]);



        $this->run($instance);



        return $instance;

    }



    public function run(WorkflowInstance $instance)

    {

        $workflow = Workflow::where('code', $instance->workflow_code)

            ->where('version', $instance->workflow_version)

            ->first();



        $definition = $workflow->definition;



        $steps = collect($definition['steps'])->keyBy('key');

        $map = TransitionCompiler::compile($definition['transitions']);



        while (true) {



            $stepKey = $instance->current_step;



            if (in_array($stepKey, $definition['end'])) {

                $instance->update(['status' => 'completed']);

                return;

            }



            $step = $steps[$stepKey];



            $this->validate($step, $instance);



            if ($step['type'] === 'automated') {

                $this->executeAction($step, $instance);



                $next = $map[$stepKey]['success'] ?? null;



                $this->move($instance, $next, 'success');

                continue;

            }



            if ($step['type'] === 'decision') {

                $this->createTask($instance, $step);

                return;

            }

        }

    }



    protected function executeAction(array $step, WorkflowInstance $instance)

    {

        $class = $step['action']['class'];

        $action = app($class);

        $action->execute($instance);

    }



    protected function createTask($instance, $step)

    {

        WorkflowTask::create([

            'workflow_instance_id' => $instance->id,

            'step_key' => $step['key'],

            'status' => 'pending'

        ]);

    }



    public function act(WorkflowTask $task, string $event)

    {

        $instance = $task->instance;



        $workflow = Workflow::where('code', $instance->workflow_code)

            ->where('version', $instance->workflow_version)

            ->first();



        $map = TransitionCompiler::compile($workflow->definition['transitions']);



        $next = $map[$task->step_key][$event] ?? null;



        $task->update(['status' => 'done']);



        $this->move($instance, $next, $event);



        $this->run($instance);

    }



    protected function move($instance, $next, $event)

    {

        $instance->update(['current_step' => $next]);

    }



    protected function validate(array $step, WorkflowInstance $instance)

    {

        if (!isset($step['validate'])) return;



        if (isset($step['validate']['rules'])) {

            validator($instance->data, $step['validate']['rules'])->validate();

        }

    }

}

PHP



############################################

# MIGRATIONS

############################################



php artisan make:migration create_workflows_table

php artisan make:migration create_workflow_instances_table

php artisan make:migration create_workflow_tasks_table



# Replace migration content manually with earlier provided schemas



############################################

# SAMPLE ACTION

############################################



mkdir -p app/Workflow/Actions



cat > app/Workflow/Actions/SubmitRequest.php <<'PHP'

<?php



namespace App\Workflow\Actions;



use Faros\Workflow\Contracts\WorkflowAction;

use Faros\Workflow\Models\WorkflowInstance;



class SubmitRequest implements WorkflowAction

{

    public function execute(WorkflowInstance $instance): void

    {

        // Example logic

    }

}

PHP



############################################

# SEED SAMPLE WORKFLOW

############################################



php artisan make:seeder WorkflowSeeder



# Put this inside:

# Workflow::create([...]) (use earlier JSON)



############################################

# FINAL

############################################



composer dump-autoload

php artisan migrate

php artisan db:seed

php artisan serve