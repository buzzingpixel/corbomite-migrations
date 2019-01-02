<?php
declare(strict_types=1);

use corbomite\di\Di;
use Phinx\Console\PhinxApplication;
use corbomite\cli\factories\ArrayInputFactory;
use corbomite\cli\services\CliQuestionService;
use corbomite\migrations\services\PreFlightService;
use Symfony\Component\Console\Output\ConsoleOutput;
use corbomite\migrations\actions\CreateMigrationAction;
use corbomite\migrations\utilities\CaseConversionUtility;

return [
    PreFlightService::class => function () {
        return new PreFlightService(new ConsoleOutput());
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
];
