<?php

declare(strict_types=1);

return [
    'sync' => ['queue' => false],
    'ui' => [
        'packages' => [
            'platform/src' => 'Rimba\Platform',
        ],
        'panels' => [
            // panel_id, path, color, brandName, homeUrl
            'admin' => ['admin', 'admin', '#7f174b', 'Administrator Portal', 'filament.staff.pages.dashboard'],
            'staff' => ['staff', 'staff', '#09829f', 'ATM Staff Intranet', 'welcome'],
        ],
    ],
    'unit_roles' => ['owner','member'],
    'team_roles' => ['captain','scout', 'player', 'quartermaster', 'tactician', 'coach'],
];
