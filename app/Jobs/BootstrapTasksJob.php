<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Support\Todo\WorkPackage;
use App\Models\Support\Todo\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class BootstrapTasksJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(public WorkPackage $wp) {}

    public function handle()
    {
        $template = $this->wp->template()
            ->with('items.taskTemplate')
            ->first();

        foreach ($template->items as $item) {
            $task = Task::create([
                'work_package_id' => $this->wp->id,
                'task_template_id' => $item->task_template_id,
                'title' => $item->taskTemplate->name,
                'description' => $item->taskTemplate->description,
                'seq' => $item->seq,
                'list' => $item->list,
                'role_id' => $item->taskTemplate->role_id,
                'action_url' => $item->taskTemplate->action_url,
                'status' => $item->seq === 1 ? 'queue' : 'blocked',
            ]);

            RunPreTaskJob::dispatch($task);
        }
    }
}