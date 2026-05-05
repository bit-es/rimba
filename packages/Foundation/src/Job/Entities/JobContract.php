<?php

declare(strict_types=1);

namespace Bites\Foundation\Job\Entities;

use Bites\Foundation\Person\Entities\Staff;
use Bites\Support\Shared\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'job_position_id',
    'staff_id',
    'uuid',
    'staff_type',
    'legal_employer',
    'headcount_type',   // internal / external
    'agreement_type',   // COS, MSA, Internship
    'start_date',
    'end_date',
])]
class JobContract extends Model
{
    use HasAttributes;

    public function position(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
}
