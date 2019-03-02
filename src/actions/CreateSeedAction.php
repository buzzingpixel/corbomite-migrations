<?php
declare(strict_types=1);

/**
 * @author TJ Draper <tj@buzzingpixel.com>
 * @copyright 2019 BuzzingPixel, LLC
 * @license Apache-2.0
 */

namespace corbomite\migrations\actions;

use Phinx\Console\PhinxApplication;
use corbomite\cli\models\CliArgumentsModel;
use corbomite\cli\factories\ArrayInputFactory;
use corbomite\cli\services\CliQuestionService;
use corbomite\migrations\services\PreFlightService;
use Symfony\Component\Console\Output\OutputInterface;
use corbomite\migrations\utilities\CaseConversionUtility;

class CreateSeedAction
{
    private $preFlightService;
    private $cliQuestionService;
    private $caseConversionUtility;
    private $phinxApplication;
    private $arrayInputFactory;
    private $consoleOutput;

    public function __construct(
        PreFlightService $preFlightService,
        CliQuestionService $cliQuestionService,
        CaseConversionUtility $caseConversionUtility,
        PhinxApplication $phinxApplication,
        ArrayInputFactory $arrayInputFactory,
        OutputInterface $consoleOutput
    ) {
        $this->preFlightService = $preFlightService;
        $this->cliQuestionService = $cliQuestionService;
        $this->caseConversionUtility = $caseConversionUtility;
        $this->phinxApplication = $phinxApplication;
        $this->arrayInputFactory = $arrayInputFactory;
        $this->consoleOutput = $consoleOutput;
    }

    public function __invoke(CliArgumentsModel $argModel): ?int
    {
        ($this->preFlightService)();

        if (! $name = $argModel->getArgumentByIndex(2)) {
            $name = $this->cliQuestionService->ask(
                '<fg=cyan>Provide a seed name: </>'
            );
        }

        $name = $this->caseConversionUtility->convertStringToPascale($name);

        $input = $this->arrayInputFactory->make([
            'seed:create',
            'name' => $name,
        ]);

        return $this->phinxApplication->doRun($input, $this->consoleOutput);
    }
}
