<?php

declare(strict_types=1);

namespace Bites\Platform\Sync\Services;

use Bites\Platform\Sync\Actions\FetchDatabaseData;
use Bites\Platform\Sync\Actions\FetchRestData;
use Bites\Platform\Sync\Entities\ApiConfig;
use Bites\Platform\Sync\Entities\ApiData;
use Bites\Platform\Utility\PutFingerPrint;

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
