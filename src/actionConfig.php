<?php
declare(strict_types=1);

use corbomite\migrations\actions\CreateSampleConfig;
use corbomite\migrations\actions\CreateMigrationAction;

return [
    'migration' => [
        'description' => 'Corbomite Migrations Commands',
        'commands' => [
            'create-sample-config' => [
                'description' => 'Creates phinx.php config file with sample values',
                'class' => CreateSampleConfig::class,
            ],
            'create' => [
                'description' => 'Creates a migration',
                'class' => CreateMigrationAction::class,
            ],
        ],
    ],
];
