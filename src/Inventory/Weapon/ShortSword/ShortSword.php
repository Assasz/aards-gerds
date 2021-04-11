<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Weapon\ShortSword;

use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Inventory\Weapon\Weapon;
use AardsGerds\Game\Inventory\Weapon\WeaponType;
use AardsGerds\Game\Shared\IntegerValue;

abstract class ShortSword extends Weapon
{
    public function __construct(string $name, IntegerValue $damage)
    {
        parent::__construct(
            $name,
            $damage,
            WeaponType::shortSword(),
        );
    }

    public function getRequiredWeaponMastery(): WeaponMastery
    {
        return WeaponMastery::shortSword(WeaponMasteryLevel::novice());
    }
}
