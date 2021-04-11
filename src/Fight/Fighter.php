<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;

interface Fighter
{
    public function getStrength(): Strength;

    public function getWeaponMasteryLevel(): WeaponMasteryLevel;
}
