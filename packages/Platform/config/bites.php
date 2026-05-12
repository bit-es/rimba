<?php

declare(strict_types=1);

return [
    'sync' => ['queue' => false],
    'ui' => [
        'packages' => [
            'platform/src' => 'Bites\Platform',
            'platform/src/Auth' => 'Bites\Platform\Auth',
            'platform/src/Sync' => 'Bites\Platform\Sync',
            'platform/src/Task' => 'Bites\Platform\Task',
            'platform/src/UX' => 'Bites\Platform\UX',
            'platform/src/Workflow' => 'Bites\Platform\Workflow',
        ],
        'panels' => [
            // panel_id, path, color, brandName, homeUrl
            'admin' => ['admin', 'admin', '#7f174b', 'Administration', 'filament.admin.pages.dashboard'],
            'staff' => ['staff', 'staff', '#09829f', 'ATM Staff Intranet', 'filament.staff.pages.dashboard'],
        ],
    ],
];
