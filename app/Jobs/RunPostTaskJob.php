<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Support\Todo\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class RunPostTaskJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(public Task $task) {}

    public function handle()
    {
        $action = $this->task->taskTemplate->posttask_action;

        if ($action) {
            app()->call($action, ['task' => $this->task]);
        }
    }
}