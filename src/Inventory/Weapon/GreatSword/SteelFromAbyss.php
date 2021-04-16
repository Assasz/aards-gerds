<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Weapon\GreatSword;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Inventory\Coin;

final class SteelFromAbyss extends GreatSword
{
    public function __construct()
    {
        parent::__construct(
            'Steel From Abyss',
            'Forged in the deeps of Ysen-Tala by Nameless themselves.',
            new Coin(100),
            new Coin(400),
            new Damage(80),
            WeaponMasteryLevel::warrior(),
            new Strength(80),
        );
    }
}
