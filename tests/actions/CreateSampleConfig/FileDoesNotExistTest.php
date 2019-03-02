<?php
declare(strict_types=1);

namespace corbomite\tests\actions\CreateSampleConfig;

use PHPUnit\Framework\TestCase;
use corbomite\migrations\PhpFunctions;
use corbomite\migrations\actions\CreateSampleConfig;
use Symfony\Component\Console\Output\OutputInterface;

class FileDoesNotExistTest extends TestCase
{
    /**
     * @throws \Throwable
     */
    public function test()
    {
        $output = $this->createMock(OutputInterface::class);

        $output->expects(self::once())
            ->method('writeln')
            ->with(self::equalTo(
                '<fg=green>phinx.php config file has been placed in /some/base/path ' .
                'Look over the values there and edit as needed</>'
            ));

        $phpFunctions = $this->createMock(PhpFunctions::class);

        $phpFunctions->expects(self::once())
            ->method('fileExists')
            ->with(self::equalTo('/some/base/path/phinx.php'))
            ->willReturn(false);

        $phpFunctions->expects(self::once())
            ->method('copy')
            ->with(
                self::equalTo('/migration/source/dir/path/phinx.php.example'),
                self::equalTo('/some/base/path/phinx.php')
            );

        /** @noinspection PhpParamsInspection */
        $obj = new CreateSampleConfig(
            '/some/base/path',
            $output,
            '/migration/source/dir/path',
            $phpFunctions
        );

        $obj();
    }
}
