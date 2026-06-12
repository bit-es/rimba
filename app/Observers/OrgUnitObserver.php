<?php

namespace App\Observers;

use App\Models\Org\OrgUnit;
use Spatie\Permission\Models\Role;
use App\Services\RoleManagerService;

class OrgUnitObserver
{


    public function created(OrgUnit $model): void
    {
        RoleManagerService::create($model, 'ou', 'code');
    }

    public function updated(OrgUnit $model): void
    {
        RoleManagerService::update($model, 'ou', 'code');
    }

    public function deleted(OrgUnit $model): void
    {
        RoleManagerService::delete($model, 'ou', 'code');
    }
}
