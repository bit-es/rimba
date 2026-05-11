<?php

declare(strict_types=1);

namespace Bites\Platform\Workflow\Entities;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Connection('sqlite')]
#[Table('workflow_instances')]
class WorkflowInstance extends Model
{
    //
}
