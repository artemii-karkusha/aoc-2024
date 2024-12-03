<?php

declare(strict_types=1);

namespace ArtemiiKarkusha\Aoc2024;

class InputDataLinesExtractor
{
    public const string DELIMETER_FOR_LINES = "\n";

    /**
     * @param InputGetterInterface $inputGetter
     */
    public function __construct(
        private readonly InputGetterInterface $inputGetter
    ) {
    }

    /**
     * returns [
     *  "line items",
     *  "line items",
     *   ...
     * ]
     *
     * @return array
     */
    public function getInputDataLines(): array
    {
        return explode(self::DELIMETER_FOR_LINES, $this->inputGetter->getInputData());
    }

    /**
     * @return string
     */
    public function getInputData(): string
    {
        return $this->inputGetter->getInputData();
    }
}
