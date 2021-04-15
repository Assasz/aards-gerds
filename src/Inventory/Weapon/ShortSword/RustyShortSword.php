<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Weapon\ShortSword;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Inventory\Coin;

final class RustyShortSword extends ShortSword
{
    public function __construct()
    {
        parent::__construct(
            'Rusty Short Sword',
            'Blade is covered in little rust, but it seems to be usable.',
            new Coin(1),
            new Damage(10),
            WeaponMastery::shortSword(WeaponMasteryLevel::novice()),
            new Strength(5),
        );
    }
}
