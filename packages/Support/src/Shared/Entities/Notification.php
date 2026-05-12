<?php

declare(strict_types=1);

namespace Bites\Support\Shared\Entities;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Connection('sqlite')]
#[Table('notifications')]
class Notification extends Model
{
    //
}
