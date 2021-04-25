<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Build\Talent\Effect\BlockImmunity;

final class Block
{
    private const MINIMAL_CHANCE = 0.1;
    private const MAXIMAL_CHANCE = 0.9;

    /**
     * Bonus per level of (advantage in) weapon mastery
     * For example: 6 level vs 0 level = 6 x 0.05 + 6 x 0.5 = 0.6
     */
    private const BONUS_FOR_WEAPON_MASTERY = 0.05;

    /**
     * Bonus per point of advantage in strength, limited to 100 points
     * For example: 150 points vs 50 points = 100 x 0.005 = 0.5
     */
    private const BONUS_FOR_STRENGTH = 0.005;

    /**
     * @example
     * attacker: 2 wm, 50 str
     * target: 4 wm, 80 str
     * bonus for wm: 4 x 0.05 = 0.2
     * bonus for advantage: 2 x 0.05 + 30 x 0.005 = 0.1 + 0.15 = 0.25
     * expected chance: minimal + bonuses = 0.1 + 0.2 + 0.25 = 0.55
     *
     * @example
     * attacker: 4 wm, 80 str
     * target: 2 wm, 50 str
     * bonus for wm: 2 x 0.05 = 0.1
     * bonus for advantage: 0
     * expected chance: minimal + bonuses = 0.1 + 0.1 = 0.2
     */
    public static function calculateChance(
        Fighter $attacker,
        Fighter $target,
        Attack $attack,
    ): float {
        if (self::cannotBeBlocked($attack)) {
            return 0;
        }

        $chance = self::MINIMAL_CHANCE;

        $bonusForWeaponMastery = $target->getWeaponMasteryLevel()->get() * self::BONUS_FOR_WEAPON_MASTERY;
        $chance += $bonusForWeaponMastery;

        if ($target->getWeaponMasteryLevel()->isGreaterThan($attacker->getWeaponMasteryLevel())) {
            $advantageInWeaponMastery = $target->getWeaponMasteryLevel()->diff($attacker->getWeaponMasteryLevel());
            $chance += $advantageInWeaponMastery->get() * self::BONUS_FOR_WEAPON_MASTERY;
        }

        if ($target->getStrength()->isGreaterThan($attacker->getStrength())) {
            $advantageInStrength = $target->getStrength()->diff($attacker->getStrength());
            $chance += $advantageInStrength->get() * self::BONUS_FOR_STRENGTH;
        }

        if ($chance > self::MAXIMAL_CHANCE) {
            $chance = self::MAXIMAL_CHANCE;
        }

        return $chance;
    }

    private static function cannotBeBlocked(Attack $attack): bool
    {
        return $attack->getEffects()->has(BlockImmunity::getName()) || $attack instanceof EtherumAttack;
    }
}
