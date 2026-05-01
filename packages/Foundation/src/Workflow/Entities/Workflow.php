<?php

declare(strict_types=1);

namespace Bites\Foundation\Workflow\Entities;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Connection('sqlite')]
#[Table('workflows')]
#[\Illuminate\Database\Eloquent\Attributes\Fillable(['code', 'name', 'description'])]
class Workflow extends Model
{
}
