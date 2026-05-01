<?php

declare(strict_types=1);

namespace Bites\Support\Shared\Entities;

use Bites\Foundation\Job\Entities\JobPosition;
use Bites\Foundation\Org\Entities\Organization;
use Bites\Foundation\Person\Entities\Staff;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

#[Fillable([
    'code',        // e.g. plant, grade, skill, cost_center
    'value',       // string / json
    'value_type',  // string|number|boolean|json
])]
class Attribute extends Model
{
    public function organizations(): MorphToMany
    {
        return $this->morphedByMany(Organization::class, 'attributable');
    }

    public function people(): MorphToMany
    {
        return $this->morphedByMany(Staff::class, 'attributable');
    }

    public function jobs(): MorphToMany
    {
        return $this->morphedByMany(JobPosition::class, 'attributable');
    }
}
