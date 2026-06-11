<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Support\Todo\WorkPackage;
use App\Models\Support\Todo\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class RunPreWorkPackageJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(public $action, public $context = []) {}

    public function handle()
    {
        if ($this->action) {
            app()->call($this->action, $this->context);
        }
    }
}