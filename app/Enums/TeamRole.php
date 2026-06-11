<?php

// app/Enums/TeamRole.php

declare(strict_types=1);

namespace App\Enums;

enum TeamRole: string
{
    case CAPTAIN = 'captain';
    case SCOUT = 'scout';
    case PLAYER = 'player';
    case QUARTERMASTER = 'quartermaster';
    case TACTICIAN = 'tactician';
    case COACH = 'coach';
}