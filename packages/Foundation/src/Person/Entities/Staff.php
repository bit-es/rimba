<?php

declare(strict_types=1);

namespace Bites\Foundation\Person\Entities;

use Bites\Foundation\Job\Entities\JobContract;
use Bites\Foundation\Org\Entities\OrgTeam;
use Bites\Support\Shared\Entities\Attribute;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Bites\Support\Shared\Concerns\HasAttributes;

#[Fillable([
    'full_name',
    'staff_type', // FTE, FTC, TPC, INTERN
])]
class Staff extends Model
{
    use HasAttributes;

    public function contracts(): HasMany
    {
        return $this->hasMany(JobContract::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(OrgTeam::class, 'org_team_members');
    }
}
