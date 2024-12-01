<?php

declare(strict_types=1);

namespace Advent\Day1;

interface ArraySorterInterface
{
    public function sort(array $array): array;
}