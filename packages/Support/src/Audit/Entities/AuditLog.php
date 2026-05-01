<?php

declare(strict_types=1);

namespace Bites\Support\Audit\Entities;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Connection('sqlite')]
#[Table('audit_logs')]
class AuditLog extends Model
{
    //
}
