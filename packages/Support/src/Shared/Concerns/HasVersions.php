<?php

declare(strict_types=1);

namespace Bites\Support\Shared\Concerns;

use Bites\Support\Shared\Entities\Version;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasVersions
{
    public function versions(): MorphMany
    {
        return $this->morphMany(Version::class, 'versionable')
            ->latest('id');
    }

    public function createVersion(
        string $level = 'patch',
        ?string $notes = null,
        ?string $contentPath = null,
        ?string $contentUrl = null,
        ?string $contentType = null,
    ) {
        [$major, $minor, $patch] = $this->nextVersion($level);

        return $this->versions()->create([
            'data'          => $this->getVersionedAttributes(),
            'major'         => $major,
            'minor'         => $minor,
            'patch'         => $patch,
            'semver'        => "{$major}.{$minor}.{$patch}",
            'notes'         => $notes,
            'content_path'  => $contentPath,
            'content_url'   => $contentUrl,
            'content_type'  => $contentType,
            'status'        => 'draft',
            'user_id'       => auth()->id(),
        ]);
    }

    protected function nextVersion(string $level): array
    {
        $latest = $this->versions()->latest('id')->first();

        if (!$latest) {
            return [1, 0, 0];
        }

        $major = $latest->major;
        $minor = $latest->minor;
        $patch = $latest->patch;

        return match ($level) {
            'major' => [$major + 1, 0, 0],
            'minor' => [$major, $minor + 1, 0],
            'patch' => [$major, $minor, $patch + 1],
            default => [$major, $minor, $patch + 1],
        };
    }

    public function restoreVersion(Version $version): void
    {
        $this->fill($version->data);
        $this->save();
    }

    protected function getVersionedAttributes(): array
    {
        return collect($this->attributesToArray())
            ->except(['created_at', 'updated_at'])
            ->toArray();
    }
    public function approveVersion(Version $version): void
    {
        if (!$version->isDraft()) {
            throw new \Exception('Only draft versions can be approved.');
        }

        $version->update([
            'status' => 'approved',
        ]);
    }

    public function publishVersion(Version $version): void
    {
        if (!$version->isApproved()) {
            throw new \Exception('Version must be approved before publishing.');
        }

        // Optional: unpublish old versions
        $this->versions()
            ->where('status', 'published')
            ->update(['status' => 'archived']);

        $version->update([
            'status' => 'published',
        ]);

        // Optional: set as current version
        if (method_exists($this, 'setCurrentVersion')) {
            $this->setCurrentVersion($version);
        }
    }

    public function rejectVersion(Version $version): void
    {
        if (!$version->isDraft()) {
            throw new \Exception('Only draft versions can be rejected.');
        }

        $version->update([
            'status' => 'rejected',
        ]);
    }
}
