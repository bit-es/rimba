<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Support\Sync\ApiData;

class ProcessingService
{
    public function process(ApiData $data): void
    {
        dump("Processing API data ID: {$data->id} with config: {$data->apiConfig->name}");
        try {
            app(MappingService::class)->run($data);
            $data->markProcessed();
        } catch (\Throwable $throwable) {
            $data->markFailed($throwable->getMessage());
            throw $throwable;
        }
    }
}
