<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Weapon;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Inventory\Coin;
use AardsGerds\Game\Inventory\InventoryItem;

abstract class Weapon extends InventoryItem
{
    public function __construct(
        string $name,
        string $description,
        Coin $sellValue,
        Coin $buyValue,
        protected WeaponType $type,
        protected Damage $damage,
        protected WeaponMastery $requiredWeaponMastery,
    ) {
        parent::__construct($name, $description, $sellValue, $buyValue);
    }

    public function getType(): WeaponType
    {
        return $this->type;
    }

    public function getDamage(): Damage
    {
        return $this->damage;
    }
}
