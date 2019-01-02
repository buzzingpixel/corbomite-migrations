<?php
declare(strict_types=1);

namespace corbomite\migrations\services;

use LogicException;
use Symfony\Component\Console\Output\OutputInterface;

class PreFlightService
{
    private $consoleOutput;

    public function __construct(OutputInterface $consoleOutput)
    {
        $this->consoleOutput = $consoleOutput;
    }

    public function __invoke(): void
    {
        if (file_exists(APP_BASE_PATH . '/phinx.php')) {
            return;
        }

        if (! defined('APP_BASE_PATH')) {
            throw new LogicException('APP_BASE_PATH must be defined');
        }

        defined('ENTRY_POINT') || define('ENTRY_POINT', 'app');

        $this->consoleOutput->writeln(
            '<fg=red>phinx.php config file does not exist</>'
        );

        $this->consoleOutput->writeln(
            '<fg=yellow>Please run php' . ENTRY_POINT . ' migration/create-sample-config</>'
        );

        exit();
    }
}
