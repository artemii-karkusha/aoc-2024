<?php

declare(strict_types=1);

namespace Advent\Day3;

class MulMultiplier
{
    private const string EXPRATION = "/(){1}\\w+,{1}\\w+/i";

    /**
     * @param string $mul
     * @return int
     */
    public function getMultipliedResult(string $mul): int
    {
        if (!preg_match_all(self::EXPRATION, $mul, $digits)) {
            return 0;
        }

        [$digit1, $digit2] = explode(',', $digits[0][0]);
        return ($digit1 * $digit2);
    }
}
