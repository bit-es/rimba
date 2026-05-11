<?php

declare(strict_types=1);

namespace Bites\Platform\Workflow\Entities;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Connection('sqlite')]
#[Table('workflows')]
#[Fillable(['code', 'name', 'description'])]
class Workflow extends Model {}
