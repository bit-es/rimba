<?php

declare(strict_types=1);

namespace Bites\Foundation\Org\Entities;

use Bites\Foundation\Job\Entities\JobPosition;
use Bites\Support\Shared\Entities\Attribute;
use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

#[Connection('sqlite')]
#[Table('org_units')]
#[\Illuminate\Database\Eloquent\Attributes\Fillable([
    'organization_id',
    'name',
    'owner_job_position_id',
])]
class OrgUnit extends Model
{
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function ownerPosition(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class, 'owner_job_position_id');
    }

    public function attributes(): MorphToMany
    {
        return $this->morphToMany(Attribute::class, 'attributable');
    }
}
