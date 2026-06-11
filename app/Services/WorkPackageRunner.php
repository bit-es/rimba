<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Support\Todo\WorkPackage;
use Illuminate\Support\Facades\Bus;
use App\Jobs\CreateWorkPackageJob;
use App\Jobs\RunPreWorkPackageJob;

class WorkPackageRunner
{
    public static function run(
        int $templateId,
        ?string $refType = null,
        ?int $refId = null,
        ?string $pretask = null
    ) {
        Bus::chain([
            new RunPreWorkPackageJob($pretask),
            new CreateWorkPackageJob($templateId, $refType, $refId),
        ])->dispatch();
    }
}