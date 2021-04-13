<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\WeaponMastery;

use AardsGerds\Game\Build\Talent\Talent;

interface WeaponMasteryTalent extends Talent
{
    public static function getRequiredWeaponMastery(): WeaponMastery;
}
