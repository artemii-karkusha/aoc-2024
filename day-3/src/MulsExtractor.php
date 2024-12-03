<?php

declare(strict_types=1);

namespace Advent\Day3;

use ArtemiiKarkusha\Aoc2024\InputDataLinesExtractor;
use Generator;

class MulsExtractor
{
    private const string EXPRATION = '/(mul)(\(){1}\w+,{1}\w+(\))/i';

    /**
     * @param InputDataLinesExtractor $dataLinesExtractor
     */
    public function __construct(
        private readonly InputDataLinesExtractor $dataLinesExtractor
    ) {
    }

    /**
     * @return Generator
     */
    public function getAllMuls(): Generator
    {
        $inputDataLines = $this->dataLinesExtractor->getInputDataLines();

        foreach ($inputDataLines as $inputDataLine) {
            preg_match_all(self::EXPRATION, $inputDataLine, $linesMuls);
            foreach ($linesMuls[0] as $mul) {
                yield $mul;
            }
        }
    }

    /**
     * @return Generator
     */
    public function getEnabledMuls(): Generator
    {
        $inputData = $this->dataLinesExtractor->getInputData();

        $inputDataWithEnabledCode = $this->getTrimedCode($this->getEnabledExecutionCode($inputData));

        preg_match_all(self::EXPRATION, $inputDataWithEnabledCode, $linesMuls);
        foreach ($linesMuls[0] as $mul) {
            yield $mul;
        }
    }

    /**
     * @param string $inputData
     * @param true $isExecutionCodeEnabled
     * @return string
     */
    private function getEnabledExecutionCode(string $inputData, bool $isExecutionCodeEnabled = true): string
    {
        $enabledExecution = '';
        $declarationForDisabling = 'don\'t()';
        $declarationForEnabling = 'do()';

        if ($isExecutionCodeEnabled) {
            $positionOfDeclaration = strpos($inputData, $declarationForDisabling);

            if (!$positionOfDeclaration) {
                return $inputData;
            }

            $enabledExecution = mb_substr($inputData, 0, $positionOfDeclaration);
            $inputData = mb_substr($inputData, $positionOfDeclaration + 7);
            $isExecutionCodeEnabled = false;
        }

        if (!$isExecutionCodeEnabled) {
            $positionOfDeclaration = strpos($inputData, $declarationForEnabling);
            $inputData = $positionOfDeclaration ? mb_substr($inputData, $positionOfDeclaration + 4) : '';

            if (!$positionOfDeclaration) {
                return $enabledExecution;
            }

            $isExecutionCodeEnabled = true;
        }

        $enabledExecution .= $this->getEnabledExecutionCode($inputData, $isExecutionCodeEnabled);

        return $enabledExecution;
    }

    /**
     * @param string $enabledExecution
     * @return string
     */
    private function getTrimedCode(string $enabledExecution): string
    {
        return str_replace('do()', '', $enabledExecution);
    }
}
