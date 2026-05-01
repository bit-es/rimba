<?php

declare(strict_types=1);

namespace Bites\Foundation\Org\Entities;

use Bites\Foundation\Person\Entities\Staff;
use Bites\Support\Shared\Entities\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

#[\Illuminate\Database\Eloquent\Attributes\Fillable([
    'organization_id',
    'name',
    'owner_staff_id',
])]
class OrgTeam extends Model
{
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'owner_staff_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Staff::class, 'org_team_members')->withTimestamps();
    }

    public function attributes(): MorphToMany
    {
        return $this->morphToMany(Attribute::class, 'attributable');
    }
}
