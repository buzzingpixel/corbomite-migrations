<?php
declare(strict_types=1);

namespace corbomite\tests\actions\SeedRunAction;

use PHPUnit\Framework\TestCase;
use Phinx\Console\PhinxApplication;
use corbomite\cli\models\CliArgumentsModel;
use corbomite\cli\factories\ArrayInputFactory;
use Symfony\Component\Console\Input\ArrayInput;
use corbomite\migrations\actions\SeedRunAction;
use corbomite\migrations\services\PreFlightService;
use Symfony\Component\Console\Output\OutputInterface;

class NameArgNotProvidedTest extends TestCase
{
    /**
     * @throws \Throwable
     */
    public function test()
    {
        $arrayInput = $this->createMock(ArrayInput::class);

        $consoleOutput = $this->createMock(OutputInterface::class);

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
            ->with(self::equalTo(['seed:run']))
            ->willReturn($arrayInput);

        /** @noinspection PhpParamsInspection */
        $obj = new SeedRunAction(
            $preFlightService,
            $phinxApplication,
            $arrayInputFactory,
            $consoleOutput
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
