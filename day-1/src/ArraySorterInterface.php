<?php

declare(strict_types=1);

namespace Advent\Day1;

interface ArraySorterInterface
{
    /**
     * @param array $array
     * @return array
     */
    public function sort(array $array): array;
}
