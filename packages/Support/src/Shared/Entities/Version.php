<?php

namespace Bites\Support\Shared\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Version extends Model
{
    protected $fillable = [
        'data',
        'event',
        'major',
        'minor',
        'patch',
        'semver',
        'notes',
        'content_path',
        'content_url',
        'content_type',
        'status',
        'user_id',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | Status Helpers
    |--------------------------------------------------------------------------
    */

    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }


    public function versionable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Optional accessor (if you ever drop semver column)
    public function getSemverAttribute($value)
    {
        return $value ?? "{$this->major}.{$this->minor}.{$this->patch}";
    }
}