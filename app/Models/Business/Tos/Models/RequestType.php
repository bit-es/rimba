<?php

namespace App\Models\Business\Tos\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'workflow_id',
        'name',
        'extra',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'workflow_id' => 'integer',
            'extra' => 'array',
        ];
    }

    public function workflow(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Process\Workflow::class);
    }
}
