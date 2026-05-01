<?php

declare(strict_types=1);

namespace Bites\Platform\Sync\Jobs;

use Bites\Platform\Sync\Entities\ApiData;
use Bites\Platform\Sync\Services\ProcessingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
