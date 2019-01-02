<?php
declare(strict_types=1);

namespace corbomite\migrations\actions;

use LogicException;
use Symfony\Component\Console\Output\OutputInterface;

class CreateSampleConfig
{
    private $migrationsSrcDir;
    private $output;

    public function __construct(
        string $migrationsSrcDir,
        OutputInterface $output
    ) {
        $this->migrationsSrcDir = $migrationsSrcDir;
        $this->output = $output;
    }

    public function __invoke()
    {
        if (! defined('APP_BASE_PATH')) {
            throw new LogicException('APP_BASE_PATH must be defined');
        }

        if (file_exists(APP_BASE_PATH . '/phinx.php')) {
            $this->output->writeln(
                '<fg=red>phinx.php config file already exists. Please ' .
                'remove or rename that file before generating new sample file </>'
            );

            return;
        }

        copy(
            $this->migrationsSrcDir . '/phinx.php.example',
            APP_BASE_PATH . '/phinx.php'
        );

        $this->output->writeln(
            '<fg=green>phinx.php config file has been placed in APP_BASE_PATH. ' .
            'Look over the values there and edit as needed</>'
        );
    }
}
