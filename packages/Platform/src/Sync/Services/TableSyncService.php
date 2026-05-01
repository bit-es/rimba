<?php

declare(strict_types=1);

namespace Bites\Platform\Sync\Services;

use Illuminate\Support\Facades\DB;

class TableSyncService
{
    public function sync(string $table, ?string $uniqueBy, array $data)
    {
        if ($uniqueBy && isset($data[$uniqueBy])) {
            DB::table($table)->updateOrInsert(
                [$uniqueBy => $data[$uniqueBy]],
                $data
            );

            return DB::table($table)->where($uniqueBy, $data[$uniqueBy])->first();
        }

        $id = DB::table($table)->insertGetId($data);

        return DB::table($table)->find($id);
    }
}
