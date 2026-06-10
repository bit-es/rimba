<?php

namespace App\Models\Business\Dms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'org_team_id',
        'org_unit_id',
        'location_id',
        'type',
        'title',
        'description',
        'attributes',
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
            'org_team_id' => 'integer',
            'org_unit_id' => 'integer',
            'location_id' => 'integer',
            'attributes' => 'array',
        ];
    }

    public function versionable(): MorphOne
    {
        return $this->morphOne(\App\Models\Support\Copies\Versionable::class, 'versionableable');
    }

    public function documentCategoryAssignments(): HasMany
    {
        return $this->hasMany(DocumentCategoryAssignment::class);
    }

    public function orgTeam(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Org\OrgTeam::class);
    }

    public function orgUnit(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Org\OrgUnit::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Support\FloorPlan\Location::class);
    }
}
