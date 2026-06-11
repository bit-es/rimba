<?php

// app/Enums/UnitRole.php

declare(strict_types=1);

namespace App\Enums;

enum UnitRole: string
{
    case OWNER = 'owner';
    case MEMBER = 'member';
}