<?php
declare(strict_types=1);

/**
 * @author TJ Draper <tj@buzzingpixel.com>
 * @copyright 2019 BuzzingPixel, LLC
 * @license Apache-2.0
 */

use corbomite\migrations\actions\MigrateUpAction;
use corbomite\migrations\actions\CreateSeedAction;
use corbomite\migrations\actions\MigrateDownAction;
use corbomite\migrations\actions\CreateSampleConfig;
use corbomite\migrations\actions\MigrateStatusAction;
use corbomite\migrations\actions\CreateMigrationAction;

return [
    'migrate' => [
        'description' => 'Corbomite Migration Commands',
        'commands' => [
            'create-sample-config' => [
                'description' => 'Creates phinx.php config file with sample values',
                'class' => CreateSampleConfig::class,
            ],
            'create' => [
                'description' => 'Creates a migration',
                'class' => CreateMigrationAction::class,
            ],
            'status' => [
                'description' => 'Lists migration status',
                'class' => MigrateStatusAction::class,
            ],
            'up' => [
                'description' => 'Runs migrations that need to run',
                'class' => MigrateUpAction::class,
            ],
            'down' => [
                'description' => 'Rolls back previous migration or to specified target',
                'class' => MigrateDownAction::class,
            ],
        ],
    ],
    'seed' => [
        'description' => 'Corbomite Seed Commands',
        'commands' => [
            'create' => [
                'description' => 'Creates a seeder',
                'class' => CreateSeedAction::class,
            ],
        ],
    ],
];
