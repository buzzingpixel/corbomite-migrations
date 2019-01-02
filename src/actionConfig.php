<?php
declare(strict_types=1);

use corbomite\migrations\actions\CreateMigrationAction;

return [
    'migration' => [
        'description' => 'Corbomite Migrations Commands',
        'commands' => [
            'create' => [
                'description' => 'Creates a migration',
                'class' => CreateMigrationAction::class,
            ],
        ],
    ],
];
