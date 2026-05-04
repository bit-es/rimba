<?php

declare(strict_types=1);

namespace Bites\Platform\Sync\Jobs;

use Bites\Platform\Sync\Models\ApiData;
use Bites\Platform\Sync\Services\ProcessingService;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessApiDataJob implements ShouldQueue
{
    use \Illuminate\Foundation\Queue\Queueable;

    public ApiData $data;

    public function __construct(ApiData $data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        app(ProcessingService::class)->process($this->data);
    }

    /**
     * ✅ Optional but recommended defaults
     */
    public $tries = 3;

    public $timeout = 120;
}
