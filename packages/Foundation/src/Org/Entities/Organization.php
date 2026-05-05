<?php

declare(strict_types=1);

namespace Bites\Foundation\Org\Entities;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Connection('sqlite')]
#[Table('organizations')]
#[Fillable(['name', 'uuid', 'description', 'type', 'effective_from', 'effective_to'])]
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
}
