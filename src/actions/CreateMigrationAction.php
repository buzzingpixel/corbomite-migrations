<?php
declare(strict_types=1);

namespace corbomite\migrations\actions;

use Phinx\Console\PhinxApplication;
use corbomite\cli\models\CliArgumentsModel;
use corbomite\cli\factories\ArrayInputFactory;
use corbomite\cli\services\CliQuestionService;
use Symfony\Component\Console\Output\OutputInterface;
use corbomite\migrations\utilities\CaseConversionUtility;

class CreateMigrationAction
{
    private $cliQuestionService;
    private $caseConversionUtility;
    private $phinxApplication;
    private $arrayInputFactory;
    private $consoleOutput;

    public function __construct(
        CliQuestionService $cliQuestionService,
        CaseConversionUtility $caseConversionUtility,
        PhinxApplication $phinxApplication,
        ArrayInputFactory $arrayInputFactory,
        OutputInterface $consoleOutput
    ) {
        $this->cliQuestionService = $cliQuestionService;
        $this->caseConversionUtility = $caseConversionUtility;
        $this->phinxApplication = $phinxApplication;
        $this->arrayInputFactory = $arrayInputFactory;
        $this->consoleOutput = $consoleOutput;
    }

    public function __invoke(CliArgumentsModel $argModel): ?int
    {
        if (! $name = $argModel->getArgumentByIndex(2)) {
            $name = $this->cliQuestionService->ask(
                '<fg=cyan>Provide a migration name: </>'
            );
        }

        $name = $this->caseConversionUtility->convertStringToPascale($name);

        $input = $this->arrayInputFactory->make([
            'create',
            'name' => $name
        ]);

        return $this->phinxApplication->doRun($input, $this->consoleOutput);
    }
}
