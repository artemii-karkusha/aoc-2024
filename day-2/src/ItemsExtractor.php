<?php

declare(strict_types=1);

namespace Advent\Day2;

use ArtemiiKarkusha\Aoc2024\InputDataLinesExtractor;
use Generator;

class ItemsExtractor
{
    public const DELIMETER_FOR_ITEMS = ' ';

    /**
     * @param InputDataLinesExtractor $dataLinesExtractor
     */
    public function __construct(
        private readonly InputDataLinesExtractor $dataLinesExtractor
    ) {
    }

    public function getItems(): Generator
    {
        $inputDataLines = $this->dataLinesExtractor->getInputDataLines();

        // Extract locationsIds from finds line
        foreach ($inputDataLines as $inputDataLine) {
            $itemsFromLine = explode(self::DELIMETER_FOR_ITEMS, $inputDataLine);
            yield $itemsFromLine;
        }
    }
}