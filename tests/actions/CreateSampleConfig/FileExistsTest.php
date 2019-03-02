<?php
declare(strict_types=1);

namespace corbomite\tests\actions\CreateSampleConfig;

use PHPUnit\Framework\TestCase;
use corbomite\migrations\PhpFunctions;
use corbomite\migrations\actions\CreateSampleConfig;
use Symfony\Component\Console\Output\OutputInterface;

class FileExistsTest extends TestCase
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
                '<fg=red>phinx.php config file already exists. Please remove ' .
                'or rename that file before generating new sample file </>'
            ));

        $phpFunctions = $this->createMock(PhpFunctions::class);

        $phpFunctions->expects(self::once())
            ->method('fileExists')
            ->with(self::equalTo('/some/base/path/phinx.php'))
            ->willReturn(true);

        $phpFunctions->expects(self::never())->method('copy');

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
