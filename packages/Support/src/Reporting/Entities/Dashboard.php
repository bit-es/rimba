<?php

declare(strict_types=1);

namespace Bites\Support\Reporting\Entities;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Connection('sqlite')]
#[Table('dashboards')]
class Dashboard extends Model
{
    //
}
