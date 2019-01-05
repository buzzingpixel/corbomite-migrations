<?php
declare(strict_types=1);

/**
 * @author TJ Draper <tj@buzzingpixel.com>
 * @copyright 2019 BuzzingPixel, LLC
 * @license Apache-2.0
 */

namespace corbomite\migrations\actions;

use Phinx\Console\PhinxApplication;
use corbomite\cli\factories\ArrayInputFactory;
use corbomite\migrations\services\PreFlightService;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateUpAction
{
    private $preFlightService;
    private $phinxApplication;
    private $arrayInputFactory;
    private $consoleOutput;

    public function __construct(
        PreFlightService $preFlightService,
        PhinxApplication $phinxApplication,
        ArrayInputFactory $arrayInputFactory,
        OutputInterface $consoleOutput
    ) {
        $this->preFlightService = $preFlightService;
        $this->phinxApplication = $phinxApplication;
        $this->arrayInputFactory = $arrayInputFactory;
        $this->consoleOutput = $consoleOutput;
    }

    public function __invoke(): ?int
    {
        ($this->preFlightService)();

        $input = $this->arrayInputFactory->make(['migrate']);

        return $this->phinxApplication->doRun($input, $this->consoleOutput);
    }
}
