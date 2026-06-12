<?php

declare(strict_types=1);

namespace App\Models\Support\Extra;

use App\Models\Job\JobPosition;
use App\Models\Ppl\Staff;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Observers\AbacObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
 
#[ObservedBy([AbacObserver::class])]
#[Fillable([
    'code',        // e.g. plant, grade, skill, cost_center
    'value',       // string / json
    'value_type',  // string|number|boolean|json
])]
class Abac extends Model
{
    public function people(): MorphToMany
    {
        return $this->morphedByMany(Staff::class, 'abacable');
    }

    public function jobs(): MorphToMany
    {
        return $this->morphedByMany(JobPosition::class, 'abacable');
    }
}
