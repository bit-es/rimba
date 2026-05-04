<?php

declare(strict_types=1);

namespace Bites\Platform\Sync\Services;

use Bites\Platform\Sync\Entities\ApiData;

class MappingService
{
    public function run(ApiData $data): void
    {
        foreach ($data->api_config->mapping as $entity) {
            $this->processEntity($entity, $data->payload);
        }
    }

    protected function processEntity(array $entity, array $payload, $parent = null)
    {
        $path = $entity['path'] ?? '';
        $items = $path === '' ? $payload : data_get($payload, $path);

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

                if (isset($field['regex']) && is_string($value)) {
                    $replaced = preg_replace($field['regex'], '$1', $value);
                    $value = $replaced ?? $value;
                }

                $row[$field['to']] = $value;
            }

            // ✅ Skip invalid rows
            if (isset($entity['skip_if'])) {
                $rule = $entity['skip_if'];

                if (
                    isset($rule['field'], $rule['min_length']) &&
                    isset($row[$rule['field']]) &&
                    mb_strlen(trim((string) $row[$rule['field']])) < $rule['min_length']
                ) {
                    continue;
                }
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
