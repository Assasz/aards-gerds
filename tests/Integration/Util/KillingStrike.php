<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Integration\Util;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Talent\Effect\BlockImmunity;
use AardsGerds\Game\Build\Talent\Effect\EffectCollection;
use AardsGerds\Game\Build\Talent\TalentPoints;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryTalent;
use AardsGerds\Game\Fight\MeleeAttack;
use AardsGerds\Game\Inventory\Weapon\Weapon;

final class KillingStrike implements MeleeAttack, WeaponMasteryTalent
{
    public function getEffects(): EffectCollection
    {
        return new EffectCollection([new BlockImmunity()]);
    }

    public function __toString(): string
    {
        return self::getName();
    }

    public function getDamage(Weapon $weapon): Damage
    {
        return new Damage(10000);
    }

    public static function getName(): string
    {
        return 'Killing Strike';
    }

    public static function getDescription(): string
    {
        return 'This attack kills every opponent at once and cannot be blocked. Only for testing purpose.';
    }

    public static function getRequiredTalentPoints(): TalentPoints
    {
        return new TalentPoints(1);
    }

    public static function getRequiredWeaponMastery(): WeaponMastery
    {
        return WeaponMastery::shortSword(WeaponMasteryLevel::novice());
    }
}
