<?php

declare(strict_types=1);

namespace Advent\Day2;

use ArtemiiKarkusha\Aoc2024\ValuesDiffCalculator;

class ItemsSafetyIdentifier
{
    private const MIN_DIFF_VALUE = 1;
    private const MAX_DIFF_VALUE = 3;

    public function __construct(
        readonly private ValuesDiffCalculator $diffCalculator
    ) {
    }

    /**
     * @param int[] $items
     * @return array
     */
    public function areItemsSafe(array $items): bool
    {
        $countOfItems = count($items);
        for ($i = 0; $i < $countOfItems-1; $i++) {
            if ($this->isDiffSafe($items[$i], $items[$i+1])) {
                continue;
            }

            return false;
        }

        return true;
    }

    private function isDiffSafe(int $value1, int $value2): bool
    {
        $difference = $this->diffCalculator->calculateDiffBetweenValues($value1, $value2);
        return $difference >= self::MIN_DIFF_VALUE && $difference <= self::MAX_DIFF_VALUE;
    }
}