<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Weapon\GreatSword;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Inventory\Coin;
use AardsGerds\Game\Inventory\Weapon\EtherumVessel;
use AardsGerds\Game\Inventory\Weapon\RebredirWeapon;

final class Amuril extends GreatSword implements RebredirWeapon
{
    use EtherumVessel;

    public function __construct(
        private Etherum $etherumLoad,
    ) {
        parent::__construct(
            'Amuril',
            'Ancestral sword of House Maane. His name means "Poisoned Soul".',
            new Coin(10000),
            new Coin(10000),
            new Damage(180),
            WeaponMasteryLevel::masterOfFirstTier(),
            new Strength(100),
        );
    }
}
