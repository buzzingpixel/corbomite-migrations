<?php
declare(strict_types=1);

namespace corbomite\tests\actions\MigrateStatusAction;

use PHPUnit\Framework\TestCase;
use Phinx\Console\PhinxApplication;
use corbomite\cli\factories\ArrayInputFactory;
use Symfony\Component\Console\Input\ArrayInput;
use corbomite\migrations\services\PreFlightService;
use corbomite\migrations\actions\MigrateStatusAction;
use Symfony\Component\Console\Output\OutputInterface;

class Test extends TestCase
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
            ->willReturn(0);

        $arrayInputFactory = $this->createMock(ArrayInputFactory::class);

        $arrayInputFactory->expects(self::once())
            ->method('make')
            ->with(['status'])
            ->willReturn($arrayInput);

        /** @noinspection PhpParamsInspection */
        $obj = new MigrateStatusAction(
            $preFlightService,
            $phinxApplication,
            $arrayInputFactory,
            $consoleOutput
        );

        /** @noinspection PhpParamsInspection */
        self::assertEquals(0, $obj());
    }
}
