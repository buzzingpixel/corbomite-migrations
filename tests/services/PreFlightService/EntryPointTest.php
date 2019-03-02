<?php
declare(strict_types=1);

namespace corbomite\tests\services\PreFlightService;

use PHPUnit\Framework\TestCase;
use corbomite\cli\ExitStatement;
use corbomite\migrations\PhpFunctions;
use corbomite\migrations\services\PreFlightService;
use Symfony\Component\Console\Output\OutputInterface;

class EntryPointTest extends TestCase
{
    /**
     * @throws \Throwable
     */
    public function test()
    {
        $appBasePath = '/test/some/path';

        $exitStatement = $this->createMock(ExitStatement::class);

        $exitStatement->expects(self::once())
            ->method('exitWith')
            ->with(self::equalTo(1));

        $consoleOutput = $this->createMock(OutputInterface::class);

        $consoleOutput->expects(self::at(0))
            ->method('writeln')
            ->with(
                self::equalTo('<fg=red>phinx.php config file does not exist</>')
            );

        $consoleOutput->expects(self::at(1))
            ->method('writeln')
            ->with(
                self::equalTo(
                    '<fg=yellow>Please run php app migration/create-sample-config</>'
                )
            );

        $phpFunctions = $this->createMock(PhpFunctions::class);

        $phpFunctions->expects(self::once())
            ->method('fileExists')
            ->with(self::equalTo('/test/some/path/phinx.php'))
            ->willReturn(false);

        /** @noinspection PhpParamsInspection */
        $obj = new PreFlightService(
            $appBasePath,
            $exitStatement,
            $consoleOutput,
            $phpFunctions
        );

        $obj();

        /**********************************************************************/

        define('ENTRY_POINT', 'test');

        $appBasePath = '/test/some/path';

        $exitStatement = $this->createMock(ExitStatement::class);

        $exitStatement->expects(self::once())
            ->method('exitWith')
            ->with(self::equalTo(1));

        $consoleOutput = $this->createMock(OutputInterface::class);

        $consoleOutput->expects(self::at(0))
            ->method('writeln')
            ->with(
                self::equalTo('<fg=red>phinx.php config file does not exist</>')
            );

        $consoleOutput->expects(self::at(1))
            ->method('writeln')
            ->with(
                self::equalTo(
                    '<fg=yellow>Please run php test migration/create-sample-config</>'
                )
            );

        $phpFunctions = $this->createMock(PhpFunctions::class);

        $phpFunctions->expects(self::once())
            ->method('fileExists')
            ->with(self::equalTo('/test/some/path/phinx.php'))
            ->willReturn(false);

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
