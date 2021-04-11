<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Weapon\ShortSword;

use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Inventory\Weapon\Weapon;
use AardsGerds\Game\Inventory\Weapon\WeaponType;
use AardsGerds\Game\Shared\IntegerValue;

abstract class ShortSword extends Weapon
{
    public function __construct(
        string $name,
        IntegerValue $damage,
        Strength $requiredStrength,
        ?WeaponMastery $requiredWeaponMastery = null,
    ) {
        parent::__construct(
            $name,
            WeaponType::shortSword(),
            $damage,
            $requiredStrength,
            $requiredWeaponMastery ?? WeaponMastery::shortSword(WeaponMasteryLevel::novice()),
        );
    }
}
