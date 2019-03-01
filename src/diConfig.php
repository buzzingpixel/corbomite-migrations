<?php
declare(strict_types=1);

/**
 * @author TJ Draper <tj@buzzingpixel.com>
 * @copyright 2019 BuzzingPixel, LLC
 * @license Apache-2.0
 */

use corbomite\di\Di;
use corbomite\cli\ExitStatement;
use Composer\Autoload\ClassLoader;
use Phinx\Console\PhinxApplication;
use corbomite\cli\factories\ArrayInputFactory;
use corbomite\cli\services\CliQuestionService;
use corbomite\migrations\actions\MigrateUpAction;
use corbomite\migrations\services\PreFlightService;
use Symfony\Component\Console\Output\ConsoleOutput;
use corbomite\migrations\actions\MigrateDownAction;
use corbomite\migrations\actions\CreateSampleConfig;
use corbomite\migrations\actions\MigrateStatusAction;
use corbomite\migrations\actions\CreateMigrationAction;
use corbomite\migrations\utilities\CaseConversionUtility;

return [
    PreFlightService::class => function () {
        if (defined('APP_BASE_PATH')) {
            $appBasePath = APP_BASE_PATH;
        } else {
            $reflection = new ReflectionClass(ClassLoader::class);

            $appBasePath = dirname($reflection->getFileName(), 3);
        }

        return new PreFlightService(
            $appBasePath,
            new ExitStatement(),
            new ConsoleOutput()
        );
    },
    CreateSampleConfig::class => function () {
        if (defined('APP_BASE_PATH')) {
            $appBasePath = APP_BASE_PATH;
        } else {
            $reflection = new ReflectionClass(ClassLoader::class);

            $appBasePath = dirname($reflection->getFileName(), 3);
        }

        return new CreateSampleConfig(
            $appBasePath,
            new ConsoleOutput(),
            __DIR__
        );
    },
    CreateMigrationAction::class => function () {
        return new CreateMigrationAction(
            Di::get(PreFlightService::class),
            Di::get(CliQuestionService::class),
            new CaseConversionUtility(),
            new PhinxApplication(),
            new ArrayInputFactory(),
            new ConsoleOutput()
        );
    },
    MigrateStatusAction::class => function () {
        return new MigrateStatusAction(
            Di::get(PreFlightService::class),
            new PhinxApplication(),
            new ArrayInputFactory(),
            new ConsoleOutput()
        );
    },
    MigrateUpAction::class => function () {
        return new MigrateUpAction(
            Di::get(PreFlightService::class),
            new PhinxApplication(),
            new ArrayInputFactory(),
            new ConsoleOutput()
        );
    },
    MigrateDownAction::class => function () {
        return new MigrateDownAction(
            Di::get(PreFlightService::class),
            new PhinxApplication(),
            new ArrayInputFactory(),
            new ConsoleOutput(),
            Di::get(CliQuestionService::class)
        );
    },
];
