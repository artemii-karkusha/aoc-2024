<?php

declare(strict_types=1);

namespace Advent\Day1;

class DestinationCounter
{
    /**
     * @param ArraySorterInterface $arraySorter
     */
    public function __construct(
        private readonly ArraySorterInterface $arraySorter
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
            $destinationDifference+= $this->calculateDiffBetweenValues($sortedLocationsIdsGroupd1[$i], $sortedLocationsIdsGroupd2[$i]);
        }

        return $destinationDifference;
    }

    /**
     * @param int $value1
     * @param int $value2
     * @return int
     */
    private function calculateDiffBetweenValues(int $value1, int $value2): int
    {
        return abs($value1 - $value2);
    }
}