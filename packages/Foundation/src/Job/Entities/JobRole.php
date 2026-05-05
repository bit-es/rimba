<?php

declare(strict_types=1);

namespace Bites\Foundation\Job\Entities;

use Bites\Foundation\Org\Entities\OrgTeam;
use Bites\Support\Shared\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['code', 'description'])]
class JobRole extends Model
{
    use HasAttributes;

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(OrgTeam::class, 'org_team_job_roles');
    }
}
