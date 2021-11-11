<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Weapon\ShortSword;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Inventory\Coin;

final class ImperialSoldierSword extends ShortSword
{
    public function __construct()
    {
        parent::__construct(
            'Imperial Soldier Sword',
            'Sword used by Imperial soldiers.',
            new Coin(50),
            new Coin(100),
            new Damage(50),
            WeaponMasteryLevel::novice(),
            new Strength(20),
        );
    }
}
