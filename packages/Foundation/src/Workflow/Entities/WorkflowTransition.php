<?php

declare(strict_types=1);

namespace Bites\Foundation\Workflow\Entities;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'workflow_id',
    'from_state_id',
    'to_state_id',
    'requires_approval',
])]
class WorkflowTransition extends Model {}
