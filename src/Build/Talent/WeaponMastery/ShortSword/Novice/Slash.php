<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\WeaponMastery\ShortSword\Novice;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Talent\Effect\EffectCollection;
use AardsGerds\Game\Build\Talent\TalentPoints;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryTalent;
use AardsGerds\Game\Inventory\Weapon\ShortSword\ShortSword;
use AardsGerds\Game\Fight\Attack;

final class Slash implements Attack, WeaponMasteryTalent
{
    private const DAMAGE_MULTIPLIER = 0.9;

    public function __construct(
        private ShortSword $shortSword,
    ) {}

    public function getDamage(): Damage
    {
        return new Damage((int) round($this->shortSword->getDamage()->get() * self::DAMAGE_MULTIPLIER));
    }

    public function getEffects(): EffectCollection
    {
        return new EffectCollection([]);
    }

    public static function getName(): string
    {
        return 'Slash';
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
