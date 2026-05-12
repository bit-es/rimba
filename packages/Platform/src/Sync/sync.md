# Sync module overview

## Purpose

The `packages/Platform/src/Sync` package provides a config-driven data ingestion and model synchronization pipeline.
It loads source data from an API or database, stores it as `ApiData`, then maps and syncs it into application models.

## Key entities

### `ApiConfig`
- Defines a sync configuration.
- Fields:
  - `name`
  - `source_type` (`rest` or `database`)
  - `source_config`
  - `data_path`
  - `mapping`
  - `active`
- Casts `source_config` and `mapping` to arrays.

### `ApiData`
- Stores fetched payloads and sync status.
- Fields include `api_config_id`, `payload`, `fingerprint`, `status`, `processed_at`, and `error`.
- Observed by `ApiDataObserver`.

## Fetch flow

`FetchService::fetch(ApiConfig $config)` does the following:
1. Chooses a fetcher by `source_type`:
   - `rest` → `RestDataFetcher`
   - `database` → `DatabaseDataFetcher`
2. Fetches raw data from the configured source.
3. Extracts items using `data_path` (default: `data`).
4. Creates or reuses an `ApiData` record by `api_config_id` and payload fingerprint.
5. Saves `payload` and sets `status` to `pending`.

> Duplicate data is avoided via fingerprint deduplication.

## Processing flow

### `ApiDataObserver`
- On `created`, immediately processes the record.
- On `updated`, if status is not `processed` or `failed`:
  - dispatches `ProcessApiDataJob` when `bites.sync.queue` is enabled
  - otherwise processes immediately.

### `ProcessApiDataJob`
- Queued job that calls `ProcessingService::process($data)`.
- Uses recommended defaults like `$tries = 3` and `$timeout = 120`.

### `ProcessingService::process(ApiData $data)`
- Runs the mapping pipeline.
- Marks the record as `processed` on success.
- Marks it as `failed` and stores the error on exception.

## Mapping rules

`MappingService::run(ApiData $data)`
- Iterates through each mapping entity from the config.
- Processes entities recursively, allowing parent/child relationships.

### `processEntity()`
- Loads payload data by `entity['path']` or uses the root payload.
- Supports collection or single item via `entity['many']`.
- Builds each row from `entity['fields']`:
  - static values via `value`
  - payload extractions via `from`
  - runtime transformations via `do` (query array or artisan command string)
  - optional regex transformations via `regex` or PHP expression when prefixed with `@`
  - if `to` is omitted, the mapped value is not written to the model row
- Skips rows when `skip_if` rules apply.
- Attaches parent foreign keys for child entities via `foreign_key`.
- Optionally writes child IDs back to the parent record using `parent_key`.
- Calls `ModelSyncService::sync(...)` to persist the row.
- Recurses into `entity['children']`.

#### Example field mapping
```php
'fields' => [
    ['from' => 'uuid', 'to' => 'uuid'],
    ['from' => 'workstartdate', 'to' => 'start_date'],
    ['value' => 'FTE', 'to' => 'contract_type'],
    ['from' => 'job_title_uuid', 'to' => 'job_title_uuid'],
    [
        'do' => [
            'query' => 'SELECT id FROM job_titles WHERE uuid = ?',
            'bindings' => ['$value'],
            'column' => 'id',
        ],
        'from' => 'job_title_uuid',
        'to' => 'job_title_id',
    ],
]
```

#### Artisan command example
```php
'fields' => [
    ['from' => 'uuid', 'to' => 'uuid'],
    ['value' => 'FTE', 'to' => 'contract_type'],
    [
        'do' => "artisan:permission:create-role $value",
        'from' => 'role_name',
        'to' => 'role_command_output',
    ],
]
```

#### Artisan command with transform example
```php
'fields' => [
    [
        'do' => [
            'artisan' => 'permission:create-role $value',
            'transform' => '@"o." . strtolower($from)',
        ],
        'from' => 'permission_code',
        'to' => 'role_command_output',
    ],
]
```

> In PHP expressions, `$from` and `$value` both reference the value extracted from `from`.

## Model sync behavior

`ModelSyncService::sync(string $modelClass, ?string $uniqueBy, bool $addExtra, array $row)`
- Prepares the row against the model's fillable fields.
- If `uniqueBy` is provided and present in the row:
  - performs `updateOrCreate([$uniqueBy => ...], $fillableRow)`.
- Otherwise, creates a new model record.
- If `addExtra` is true and the model supports `setExtra()`:
  - stores remaining non-fillable values as extra metadata.

## Overall flow

1. `ApiConfig` defines what data to fetch and how to map it.
2. `FetchService` pulls data and writes `ApiData` as pending.
3. `ApiDataObserver` triggers async or sync processing.
4. `ProcessingService` runs the mapping pipeline.
5. `MappingService` transforms payload data into model records.
6. `ModelSyncService` creates or updates the target models.

## Notes

- The pipeline is intentionally simple and config-driven.
- `ApiData` status tracking allows retries and error inspection.
- The current fetch implementation only persists a single payload per fetch call, not multiple items.
