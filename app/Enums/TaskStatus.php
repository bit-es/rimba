<?php

// app/Enums/TeamRole.php

declare(strict_types=1);

namespace App\Enums;

class TaskStatus
{
    const PLANNED = 'planned';
    const QUEUE = 'queue';
    const IN_PROGRESS = 'in_progress';
    const DONE = 'done';
    const CANCELLED = 'cancelled';
}