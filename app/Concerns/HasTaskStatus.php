<?php

declare(strict_types=1);

namespace App\Concerns;

use App\Enums\TaskStatus;

trait HasTaskStatus
{
    protected function initializeHasTaskStatus()
    {
        $this->casts['status'] = TaskStatus::class;
    }
    public function markDone()
    {
        $this->update(['status' => TaskStatus::DONE]);
    }
    public function withAssignee()
    {
        $this->update(['status' => TaskStatus::IN_PROGRESS]);
    }
    public function noAssignee()
    {
        $this->update(['status' => TaskStatus::QUEUE]);
    }
}
