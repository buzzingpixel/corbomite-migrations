<?php
declare(strict_types=1);

namespace corbomite\tests\services\PreFlightService;

use PHPUnit\Framework\TestCase;
use corbomite\cli\ExitStatement;
use corbomite\migrations\PhpFunctions;
use corbomite\migrations\services\PreFlightService;
use Symfony\Component\Console\Output\OutputInterface;

class EarlyReturnTest extends TestCase
{
    /**
     * @throws \Throwable
     */
    public function test()
    {
        $appBasePath = '/test/base/path';

        $exitStatement = $this->createMock(ExitStatement::class);

        $exitStatement->expects(self::never())->method(self::anything());

        $consoleOutput = $this->createMock(OutputInterface::class);

        $consoleOutput->expects(self::never())->method(self::anything());

        $phpFunctions = $this->createMock(PhpFunctions::class);

        $phpFunctions->expects(self::once())
            ->method('fileExists')
            ->with(self::equalTo('/test/base/path/phinx.php'))
            ->willReturn(true);

        /** @noinspection PhpParamsInspection */
        $obj = new PreFlightService(
            $appBasePath,
            $exitStatement,
            $consoleOutput,
            $phpFunctions
        );

        $obj();
    }
}
