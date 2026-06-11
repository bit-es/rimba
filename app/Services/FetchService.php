<?php

declare(strict_types=1);

namespace App\Services;

use App\Actions\FetchDatabaseData;
use App\Actions\FetchRestData;
use App\Models\Support\Sync\ApiConfig;
use App\Models\Support\Sync\ApiData;
use App\Actions\PutFingerPrint;

class FetchService
{
    public function fetch(ApiConfig $config): void
    {
        $fetcher = match ($config->source_type) {
            'rest' => new FetchRestData,
            'database' => new FetchDatabaseData,
        };

        $data = $fetcher->fetch($config->source_config);

        $items = data_get($data, $config->data_path ?? 'data', $data);

        // foreach ($items as $item) {
        ApiData::firstOrCreate(
            [
                'api_config_id' => $config->id,
                'fingerprint' => PutFingerPrint::make((array) $items),
            ],
            [
                'payload' => (array) $items,
                'status' => 'pending',
            ]
        );
        // }
    }
}
