<?php

declare(strict_types=1);

namespace Advent\Day1;

class ArraySorter implements ArraySorterInterface
{
    /**
     * @param array $array
     * @return array
     */
    public function sort(array $array): array
    {
        sort($array);
        return $array;
    }
}
