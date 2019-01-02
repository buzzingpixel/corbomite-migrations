<?php
declare(strict_types=1);

use corbomite\di\Di;
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
        return new PreFlightService(new ConsoleOutput());
    },
    CreateSampleConfig::class => function () {
        return new CreateSampleConfig(__DIR__, new ConsoleOutput());
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
