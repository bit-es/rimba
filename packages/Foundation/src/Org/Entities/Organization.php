<?php

declare(strict_types=1);

namespace Bites\Foundation\Org\Entities;

use Bites\Support\Shared\Entities\Attribute;
use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

#[Connection('sqlite')]
#[Table('organizations')]
#[\Illuminate\Database\Eloquent\Attributes\Fillable(['name', 'type', 'effective_from', 'effective_to'])]
class Organization extends Model
{
    public function units(): HasMany
    {
        return $this->hasMany(OrgUnit::class);
    }

    public function teams(): HasMany
    {
        return $this->hasMany(OrgTeam::class);
    }

    public function attributes(): MorphToMany
    {
        return $this->morphToMany(Attribute::class, 'attributable');
    }
}
