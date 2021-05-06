<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\WeaponMastery\ShortSword\Novice;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Talent\Effect\EffectCollection;
use AardsGerds\Game\Build\Talent\TalentPoints;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryTalent;
use AardsGerds\Game\Fight\MeleeAttack;
use AardsGerds\Game\Inventory\Weapon\Weapon;
use JetBrains\PhpStorm\Immutable;

#[Immutable]
final class Slash implements MeleeAttack, WeaponMasteryTalent
{
    private const MIN_DAMAGE_MULTIPLIER = 80;
    private const MAX_DAMAGE_MULTIPLIER = 110;

    public function getDamage(Weapon $weapon): Damage
    {
        $damageMultiplier = rand(self::MIN_DAMAGE_MULTIPLIER, self::MAX_DAMAGE_MULTIPLIER) / 100;

        return new Damage((int) round($weapon->getDamage()->get() * $damageMultiplier));
    }

    public function getEffects(): EffectCollection
    {
        return new EffectCollection([]);
    }

    public static function getName(): string
    {
        return 'Slash';
    }

    public static function getDescription(): string
    {
        return 'Standard slash with sword. Everyone can do it.';
    }

    public static function getRequiredTalentPoints(): TalentPoints
    {
        return new TalentPoints(1);
    }

    public static function getRequiredWeaponMastery(): WeaponMastery
    {
        return WeaponMastery::shortSword(WeaponMasteryLevel::novice());
    }

    public function __toString(): string
    {
        return self::getName();
    }
}
