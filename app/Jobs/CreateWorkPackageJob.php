<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Support\Todo\WorkPackage;
use App\Models\Support\Todo\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateWorkPackageJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public WorkPackage $workPackage;

    public function __construct(
        public int $templateId,
        public ?string $refType,
        public ?int $refId
    ) {}

    public function handle()
    {
        $this->workPackage = WorkPackage::create([
            'work_package_template_id' => $this->templateId,
            'ref_type' => $this->refType,
            'ref_id' => $this->refId,
            'status' => 'queue',
        ]);
    }
}