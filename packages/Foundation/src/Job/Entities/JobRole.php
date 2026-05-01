<?php

declare(strict_types=1);

namespace Bites\Foundation\Job\Entities;

use Bites\Foundation\Org\Entities\OrgTeam;
use Bites\Support\Shared\Entities\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

#[\Illuminate\Database\Eloquent\Attributes\Fillable(['code', 'description'])]
class JobRole extends Model
{
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(OrgTeam::class, 'org_team_job_roles');
    }

    public function attributes(): MorphToMany
    {
        return $this->morphToMany(Attribute::class, 'attributable');
    }
}
