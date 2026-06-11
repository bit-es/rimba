<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Support\Todo\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class UnlockNextSequenceJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(public Task $task) {}

    public function handle()
    {
        $wp = $this->task->workPackage;

        $currentSeq = $this->task->seq;

        $allDone = $wp->tasks()
            ->where('seq', $currentSeq)
            ->where('status', '!=', 'done')
            ->doesntExist();

        if ($allDone) {
            $wp->tasks()
                ->where('seq', $currentSeq + 1)
                ->update(['status' => 'queue']);
        }
    }
}