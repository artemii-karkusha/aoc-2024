<?php

declare(strict_types=1);

namespace Advent\Day2;

use ArtemiiKarkusha\Aoc2024\ValuesDiffCalculator;

class ItemsSafetyIdentifier
{
    private const MIN_DIFF_VALUE = 1;
    private const MAX_DIFF_VALUE = 3;

    private const VALUES_ORDER_TYPE_INCREASED = 'increased';

    private const VALUES_ORDER_TYPE_DECSREASED = 'decreased';

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

        $orderType = '';
        for ($i = 0; $i < $countOfItems-1; $i++) {
            if (!$this->isDiffSafe((int)$items[$i], (int)$items[$i+1])) {
                return false;
            }

            if ($i === 0) {
                $orderType = $this->getOrderType((int)$items[$i], (int)$items[$i+1]);
            }

            if (!$this->isValuesOrderConsistent($orderType, (int)$items[$i], (int)$items[$i+1])) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param int $value1
     * @param int $value2
     * @return string
     */
    private function getOrderType(int $value1, int $value2): string
    {
        if ($this->areItemsIncreased($value1, $value2)) {
            return 'increased';
        }

        if ($this->areItemsDecreased($value1, $value2)) {
            return 'decreased';
        }

        return '';
    }

    /**
     * @param int $value1
     * @param int $value2
     * @return bool
     */
    private function isDiffSafe(int $value1, int $value2): bool
    {
        $difference = $this->diffCalculator->calculateDiffBetweenValues($value1, $value2);
        return $difference >= self::MIN_DIFF_VALUE && $difference <= self::MAX_DIFF_VALUE;
    }

    /**
     * @param int $value1
     * @param int $value2
     * @return bool
     */
    private function areItemsIncreased(int $value1, int $value2): bool
    {
        return $value2 > $value1;
    }

    /**
     * @param int $value1
     * @param int $value2
     * @return bool
     */
    private function areItemsDecreased(int $value1, int $value2): bool
    {
        return $value1 > $value2;
    }

    /**
     * @param string $orderType
     * @param int $value1
     * @param int $value2
     * @return bool
     */
    private function isValuesOrderConsistent(string $orderType, int $value1, int $value2): bool
    {
        switch ($orderType) {
            case self::VALUES_ORDER_TYPE_INCREASED:{
                return $this->areItemsIncreased($value1, $value2);
            }
            case self::VALUES_ORDER_TYPE_DECSREASED:{
                return $this->areItemsDecreased($value1, $value2);
            }
        }

        return false;
    }
}