<?php

namespace App\Observers;

use App\Models\Org\OrgTeam;
use Spatie\Permission\Models\Role;
use App\Services\RoleManagerService;

class OrgTeamObserver
{


    public function created(OrgTeam $model): void
    {
        RoleManagerService::create($model, 'ot','code');
    }

    public function updated(OrgTeam $model): void
    {
        RoleManagerService::update($model, 'ot','code');
    }

    public function deleted(OrgTeam $model): void
    {
        RoleManagerService::delete($model, 'ot','code');
    }
}
