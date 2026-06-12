<?php

namespace App\Observers;

use App\Models\Support\Extra\Abac;
use Spatie\Permission\Models\Role;
use App\Services\RoleManagerService;

class AbacObserver
{


    public function created(Abac $model): void
    {
        RoleManagerService::create($model, 'code', 'value');
    }

    public function updated(Abac $model): void
    {
        RoleManagerService::update($model, 'code', 'value');
    }

    public function deleted(Abac $model): void
    {
        RoleManagerService::delete($model, 'code', 'value');
    }
}
