<?php

declare(strict_types=1);

namespace Bites\Platform\Concerns;

use Bites\Platform\Entities\Task;

trait HasTasks
{
    public function tasks()
    {
        return $this->morphToMany(Task::class, 'taskable')
            ->withPivot(['relation_type'])
            ->withTimestamps();
    }
}