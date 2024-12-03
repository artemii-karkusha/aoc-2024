<?php

declare(strict_types=1);

namespace ArtemiiKarkusha\Aoc2024;

class ValuesDiffCalculator
{
    /**
     * @param int $value1
     * @param int $value2
     * @return int
     */
    public function calculateDiffBetweenValues(int $value1, int $value2): int
    {
        return abs($value1 - $value2);
    }
}
