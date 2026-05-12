<?php

declare(strict_types=1);

namespace Bites\Platform\Concerns;

use Bites\Platform\Entities\TaskList;

trait HasTaskLists
{
    public function taskLists()
    {
        return $this->morphToMany(TaskList::class, 'task_listable')
            ->withPivot(['order'])
            ->orderBy('pivot_order');
    }
}
