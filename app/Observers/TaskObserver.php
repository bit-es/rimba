<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Support\Todo\Task;
use App\Jobs\UnlockNextSequenceJob;
use App\Jobs\RunPostTaskJob;
use App\Jobs\RunPreTaskJob;

class TaskObserver
{
    public function updating(Task $task)
    {
        if ($task->isDirty('status') && $task->status === 'in_progress') {
            $task->started_at = now();
        }
    }

    public function updated(Task $task)
    {
        if ($task->status === 'done' && $task->wasChanged('status')) {

            $task->completed_at = now();
            $task->saveQuietly();

            RunPostTaskJob::dispatch($task);
            UnlockNextSequenceJob::dispatch($task);
        }
    }
}