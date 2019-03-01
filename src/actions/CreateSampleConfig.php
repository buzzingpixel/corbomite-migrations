<?php
declare(strict_types=1);

/**
 * @author TJ Draper <tj@buzzingpixel.com>
 * @copyright 2019 BuzzingPixel, LLC
 * @license Apache-2.0
 */

namespace corbomite\migrations\actions;

use Symfony\Component\Console\Output\OutputInterface;

class CreateSampleConfig
{
    private $output;
    private $appBasePath;
    private $migrationsSrcDir;

    public function __construct(
        string $appBasePath,
        OutputInterface $output,
        string $migrationsSrcDir
    ) {
        $this->output = $output;
        $this->appBasePath = $appBasePath;
        $this->migrationsSrcDir = $migrationsSrcDir;
    }

    public function __invoke()
    {
        if (file_exists($this->appBasePath . '/phinx.php')) {
            $this->output->writeln(
                '<fg=red>phinx.php config file already exists. Please ' .
                'remove or rename that file before generating new sample file </>'
            );

            return;
        }

        copy(
            $this->migrationsSrcDir . '/phinx.php.example',
            $this->appBasePath . '/phinx.php'
        );

        $this->output->writeln(
            '<fg=green>phinx.php config file has been placed in '. $this->appBasePath . ' '.
            'Look over the values there and edit as needed</>'
        );
    }
}
