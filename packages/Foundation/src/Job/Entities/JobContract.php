<?php

declare(strict_types=1);

namespace Bites\Foundation\Job\Entities;

use Bites\Foundation\Person\Entities\Staff;
use Bites\Support\Shared\Entities\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

#[\Illuminate\Database\Eloquent\Attributes\Fillable([
    'job_position_id',
    'staff_id',
    'staff_type',
    'legal_employer',
    'headcount_type',   // internal / external
    'agreement_type',   // COS, MSA, Internship
    'start_date',
    'end_date',
])]
class JobContract extends Model
{
    public function position(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function attributes(): MorphToMany
    {
        return $this->morphToMany(Attribute::class, 'attributable');
    }
}
