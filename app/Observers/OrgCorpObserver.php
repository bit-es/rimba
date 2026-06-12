<?php

namespace App\Observers;

use App\Models\Org\OrgCorp;
use Spatie\Permission\Models\Role;
use App\Services\RoleManagerService;

class OrgCorpObserver
{


    public function created(OrgCorp $model): void
    {
        RoleManagerService::create($model, 'oc','code');
    }

    public function updated(OrgCorp $model): void
    {
        RoleManagerService::update($model, 'oc','code');
    }

    public function deleted(OrgCorp $model): void
    {
        RoleManagerService::delete($model, 'oc','code');
    }
}
