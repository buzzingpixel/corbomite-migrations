<?php
declare(strict_types=1);

namespace corbomite\migrations\actions;

use Phinx\Console\PhinxApplication;
use corbomite\cli\models\CliArgumentsModel;
use corbomite\cli\factories\ArrayInputFactory;
use corbomite\cli\services\CliQuestionService;
use corbomite\migrations\services\PreFlightService;
use Symfony\Component\Console\Output\OutputInterface;

class MigrationDownAction
{
    private $preFlightService;
    private $phinxApplication;
    private $arrayInputFactory;
    private $consoleOutput;
    private $cliQuestionService;

    public function __construct(
        PreFlightService $preFlightService,
        PhinxApplication $phinxApplication,
        ArrayInputFactory $arrayInputFactory,
        OutputInterface $consoleOutput,
        CliQuestionService $cliQuestionService
    ) {
        $this->preFlightService = $preFlightService;
        $this->phinxApplication = $phinxApplication;
        $this->arrayInputFactory = $arrayInputFactory;
        $this->consoleOutput = $consoleOutput;
        $this->cliQuestionService = $cliQuestionService;
    }

    public function __invoke(CliArgumentsModel $argModel): ?int
    {
        ($this->preFlightService)();

        $params = [
            'rollback',
        ];

        if (($target = $argModel->getArgumentByIndex(2)) === null) {
            $target = $this->cliQuestionService->ask(
                '<fg=cyan>Specify target (0 to revert all, blank to revert last): </>',
                false
            );
        }

        if ($target !== '') {
            $params['--target'] = $target;
        }

        $input = $this->arrayInputFactory->make($params);

        return $this->phinxApplication->doRun($input, $this->consoleOutput);
    }
}
