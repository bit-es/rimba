<?php

declare(strict_types=1);

namespace Bites\Foundation\Person\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[\Illuminate\Database\Eloquent\Attributes\Fillable(['staff_id', 'employee_no'])]
class Employee extends Model
{
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Employee $employee): void {
            if (! in_array(
                $employee->staff->staff_type,
                ['FTE', 'FTC'],
                true
            )) {
                throw new \DomainException(
                    'Only FTE or FTC staff can be employees.'
                );
            }
        });
    }
}
