<?php

declare(strict_types=1);

namespace Bites\Foundation\Job\Entities;

use Bites\Foundation\Org\Entities\OrgUnit;
use Bites\Support\Shared\Entities\Attribute;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

#[Fillable([
    'org_unit_id',
    'effective_from',
    'effective_to',
])]
class JobPosition extends Model
{
    public function unit(): BelongsTo
    {
        return $this->belongsTo(OrgUnit::class, 'org_unit_id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(JobRole::class, 'job_position_roles');
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(JobContract::class);
    }

    public function attributes(): MorphToMany
    {
        return $this->morphToMany(Attribute::class, 'attributable');
    }
}
