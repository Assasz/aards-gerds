<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Inventory\Weapon\Weapon;

interface Fighter
{
    public function getStrength(): Strength;

    public function getWeaponMasteryLevel(): WeaponMasteryLevel;

    public function getWeapon(): ?Weapon;
}
