<?php

declare(strict_types=1);

namespace App\Services;

use App\Actions\DatabaseDataFetcher;
use App\Actions\RestDataFetcher;
use App\Models\Support\Sync\ApiConfig;
use App\Models\Support\Sync\ApiData;
use App\Actions\FingerPrint;

class FetchService
{
    public function fetch(ApiConfig $config): void
    {
        $fetcher = match ($config->source_type) {
            'rest' => new RestDataFetcher,
            'database' => new DatabaseDataFetcher,
        };

        $data = $fetcher->fetch($config->source_config);

        $items = data_get($data, $config->data_path ?? 'data', $data);

        // foreach ($items as $item) {
        ApiData::firstOrCreate(
            [
                'api_config_id' => $config->id,
                'fingerprint' => FingerPrint::make((array) $items),
            ],
            [
                'payload' => (array) $items,
                'status' => 'pending',
            ]
        );
        // }
    }
}
