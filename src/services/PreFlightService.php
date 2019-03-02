<?php
declare(strict_types=1);

/**
 * @author TJ Draper <tj@buzzingpixel.com>
 * @copyright 2019 BuzzingPixel, LLC
 * @license Apache-2.0
 */

namespace corbomite\migrations\services;

use corbomite\cli\ExitStatement;
use corbomite\migrations\PhpFunctions;
use Symfony\Component\Console\Output\OutputInterface;

class PreFlightService
{
    private $appBasePath;
    private $consoleOutput;
    private $exitStatement;
    private $phpFunctions;

    public function __construct(
        string $appBasePath,
        ExitStatement $exitStatement,
        OutputInterface $consoleOutput,
        PhpFunctions $phpFunctions
    ) {
        $this->appBasePath = $appBasePath;
        $this->consoleOutput = $consoleOutput;
        $this->exitStatement = $exitStatement;
        $this->phpFunctions = $phpFunctions;
    }

    public function __invoke(): void
    {
        if ($this->phpFunctions->fileExists(
            $this->appBasePath . '/phinx.php'
        )) {
            return;
        }

        $entryPoint = 'app';

        if (defined('ENTRY_POINT')) {
            $entryPoint = ENTRY_POINT;
        }

        $this->consoleOutput->writeln(
            '<fg=red>phinx.php config file does not exist</>'
        );

        $this->consoleOutput->writeln(
            '<fg=yellow>Please run php ' . $entryPoint . ' migration/create-sample-config</>'
        );

        $this->exitStatement->exitWith(1);
    }
}
