<?php
declare(strict_types=1);

namespace corbomite\tests\actions\MigrateDownAction;

use PHPUnit\Framework\TestCase;
use Phinx\Console\PhinxApplication;
use corbomite\cli\models\CliArgumentsModel;
use corbomite\cli\factories\ArrayInputFactory;
use corbomite\cli\services\CliQuestionService;
use Symfony\Component\Console\Input\ArrayInput;
use corbomite\migrations\actions\MigrateDownAction;
use corbomite\migrations\services\PreFlightService;
use Symfony\Component\Console\Output\OutputInterface;

class QuestionProvidesEmptyStringTest extends TestCase
{
    /**
     * @throws \Throwable
     */
    public function test()
    {
        $consoleOutput = $this->createMock(OutputInterface::class);

        $arrayInput = $this->createMock(ArrayInput::class);

        $preFlightService = $this->createMock(PreFlightService::class);

        $preFlightService->expects(self::once())
            ->method('__invoke');

        $phinxApplication = $this->createMock(PhinxApplication::class);

        $phinxApplication->expects(self::once())
            ->method('doRun')
            ->with(
                self::equalTo($arrayInput),
                self::equalTo($consoleOutput)
            )
            ->willReturn(1);

        $arrayInputFactory = $this->createMock(ArrayInputFactory::class);

        $arrayInputFactory->expects(self::once())
            ->method('make')
            ->with(['rollback'])
            ->willReturn($arrayInput);

        $cliQuestionService = $this->createMock(CliQuestionService::class);

        $cliQuestionService->expects(self::once())
            ->method('ask')
            ->with(
                self::equalTo('<fg=cyan>Specify target (0 to revert all, blank to revert last): </>'),
                self::equalTo(false)
            )
            ->willReturn('');

        /** @noinspection PhpParamsInspection */
        $obj = new MigrateDownAction(
            $preFlightService,
            $phinxApplication,
            $arrayInputFactory,
            $consoleOutput,
            $cliQuestionService
        );

        $argModel = $this->createMock(CliArgumentsModel::class);

        $argModel->expects(self::once())
            ->method('getArgumentByIndex')
            ->with(self::equalTo(2))
            ->willReturn(null);

        /** @noinspection PhpParamsInspection */
        self::assertEquals(1, $obj($argModel));
    }
}
