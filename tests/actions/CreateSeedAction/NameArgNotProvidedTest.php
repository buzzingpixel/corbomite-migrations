<?php
declare(strict_types=1);

namespace corbomite\tests\actions\CreateSeedAction;

use PHPUnit\Framework\TestCase;
use Phinx\Console\PhinxApplication;
use corbomite\cli\models\CliArgumentsModel;
use corbomite\cli\services\CliQuestionService;
use corbomite\cli\factories\ArrayInputFactory;
use Symfony\Component\Console\Input\ArrayInput;
use corbomite\migrations\actions\CreateSeedAction;
use corbomite\migrations\services\PreFlightService;
use Symfony\Component\Console\Output\OutputInterface;
use corbomite\migrations\utilities\CaseConversionUtility;

class NameArgNotProvidedTest extends TestCase
{
    /**
     * @throws \Throwable
     */
    public function test()
    {
        $arrayInput = $this->createMock(ArrayInput::class);

        $consoleOutput = $this->createMock(OutputInterface::class);

        $preFlightService = $this->createMock(PreFlightService::class);

        $preFlightService->expects(self::once())
            ->method('__invoke');

        $cliQuestionService = $this->createMock(CliQuestionService::class);

        $cliQuestionService->expects(self::once())
            ->method('ask')
            ->with(
                self::equalTo('<fg=cyan>Provide a seed name: </>')
            )
            ->willReturn('askedQuestionName');

        $caseConversionUtility = $this->createMock(CaseConversionUtility::class);

        $caseConversionUtility->expects(self::once())
            ->method('convertStringToPascale')
            ->with(self::equalTo('askedQuestionName'))
            ->willReturn('testOutputName');

        $phinxApplication = $this->createMock(PhinxApplication::class);

        $phinxApplication->expects(self::once())
            ->method('doRun')
            ->with(
                self::equalTo($arrayInput),
                self::equalTo($consoleOutput)
            )
            ->willReturn(1);

        $arrayInputFactory = $this->createMock(ArrayInputFactory::class);

        $arrayInputFactory->expects(self::once())
            ->method('make')
            ->with(self::equalTo([
                'seed:create',
                'name' => 'testOutputName'
            ]))
            ->willReturn($arrayInput);

        /** @noinspection PhpParamsInspection */
        $obj = new CreateSeedAction(
            $preFlightService,
            $cliQuestionService,
            $caseConversionUtility,
            $phinxApplication,
            $arrayInputFactory,
            $consoleOutput
        );

        $argModel = $this->createMock(CliArgumentsModel::class);

        $argModel->expects(self::once())
            ->method('getArgumentByIndex')
            ->with(self::equalTo(2))
            ->willReturn(null);

        /** @noinspection PhpParamsInspection */
        self::assertEquals(1, $obj($argModel));
    }
}
