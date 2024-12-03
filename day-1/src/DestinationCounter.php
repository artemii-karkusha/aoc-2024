<?php

declare(strict_types=1);

namespace Advent\Day1;

use ArtemiiKarkusha\Aoc2024\ValuesDiffCalculator;

readonly class DestinationCounter
{
    /**
     * @param ArraySorterInterface $arraySorter
     * @param ValuesDiffCalculator $valuesDiffCalculator
     */
    public function __construct(
        private ArraySorterInterface $arraySorter,
        private ValuesDiffCalculator $valuesDiffCalculator
    ) {
    }

    /**
     * @param array $locationsIdsGroupd1
     * @param array $locationsIdsGroupd2
     * @return int
     */
    public function calculateDestinationDiff(array $locationsIdsGroupd1, array $locationsIdsGroupd2): int
    {
        $sortedLocationsIdsGroupd1 = $this->arraySorter->sort($locationsIdsGroupd1);
        $sortedLocationsIdsGroupd2 = $this->arraySorter->sort($locationsIdsGroupd2);
        $countOfLocations = count($locationsIdsGroupd1);
        $destinationDifference = 0;
        for ($i = 0; $i < $countOfLocations; $i++) {
            $destinationDifference += $this->valuesDiffCalculator->calculateDiffBetweenValues(
                $sortedLocationsIdsGroupd1[$i],
                $sortedLocationsIdsGroupd2[$i]
            );
        }

        return $destinationDifference;
    }
}
