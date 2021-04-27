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

final class Protector extends GreatSword implements RebredirWeapon
{
    use EtherumVessel;

    public function __construct(
        private Etherum $etherumLoad,
    ) {
        parent::__construct(
            'Protector',
            'Legendary rebredir great sword. Once protected one of the Great Houses of Altfram.',
            new Coin(10000),
            new Coin(10000),
            new Damage(200),
            WeaponMasteryLevel::masterOfFirstTier(),
            new Strength(100),
        );
    }
}
