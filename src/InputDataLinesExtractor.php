<?php

declare(strict_types=1);

namespace ArtemiiKarkusha\Aoc2024;

class InputDataLinesExtractor
{
    public const DELIMETER_FOR_LINES = "\n";

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
}