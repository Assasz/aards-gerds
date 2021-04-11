<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

final class Action
{
    public static function blockOccured(
        Fighter $attacker,
        Fighter $target,
        Attack $attack,
    ): bool {
        return self::occured(Block::calculateChance($attacker, $target, $attack));
    }

    private static function occured(float $chance): bool
    {
        return mt_rand(1, 10000) <= $chance * 10000;
    }
}
