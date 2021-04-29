<?php

declare(strict_types=1);

namespace AardsGerds\Game\Shared;

final class Dice
{
    /**
     * @param IntegerValue $chance Chance of rolling TRUE expressed as integer value
     * @example 50% = 0.5 * 1000 = 500
     */
    public static function roll(IntegerValue $chance): bool
    {
        return mt_rand(1, 10000000) <= $chance->get() * 10000000;
    }
}
