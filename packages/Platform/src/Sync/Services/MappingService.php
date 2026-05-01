<?php

declare(strict_types=1);

namespace Bites\Platform\Sync\Services;

use Bites\Platform\Sync\Entities\ApiData;

class MappingService
{
    public function run(ApiData $data): void
    {
        foreach ($data->config->mapping as $entity) {
            $this->processEntity($entity, $data->payload);
        }
    }

    protected function processEntity(array $entity, array $payload, $parent = null)
    {
        $items = data_get($payload, $entity['path']);

        if (! $items) {
            return;
        }

        if (! ($entity['many'] ?? false)) {
            $items = [$items];
        }

        foreach ($items as $item) {
            $row = [];

            foreach ($entity['fields'] as $field) {
                $value = data_get($item, $field['from']);

                if (isset($field['regex'])) {
                    $value = preg_replace($field['regex'], '', $value);
                }

                $row[$field['to']] = $value;
            }

            if ($parent && isset($entity['foreign_key'])) {
                $row[$entity['foreign_key']] = $parent->id;
            }

            $model = app(TableSyncService::class)
                ->sync($entity['table'], $entity['unique_by'] ?? null, $row);

            foreach ($entity['children'] ?? [] as $child) {
                $this->processEntity($child, $item, $model);
            }
        }
    }
}
