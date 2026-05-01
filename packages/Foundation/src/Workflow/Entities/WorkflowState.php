<?php

declare(strict_types=1);

namespace Bites\Foundation\Workflow\Entities;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Connection('sqlite')]
#[Table('workflow_states')]
#[Fillable(['workflow_id', 'code', 'label'])]
class WorkflowState extends Model {}
