<?php
declare(strict_types=1);

use corbomite\di\Di;
use Phinx\Console\PhinxApplication;
use corbomite\cli\factories\ArrayInputFactory;
use corbomite\cli\services\CliQuestionService;
use Symfony\Component\Console\Output\ConsoleOutput;
use corbomite\migrations\actions\CreateMigrationAction;
use corbomite\migrations\utilities\CaseConversionUtility;

return [
    CreateMigrationAction::class => function () {
        return new CreateMigrationAction(
            Di::get(CliQuestionService::class),
            new CaseConversionUtility(),
            new PhinxApplication(),
            new ArrayInputFactory(),
            new ConsoleOutput()
        );
    },
];
