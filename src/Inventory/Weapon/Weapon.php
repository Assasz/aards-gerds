<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Weapon;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Inventory\Coin;
use AardsGerds\Game\Inventory\InventoryItem;

abstract class Weapon implements InventoryItem
{
    public function __construct(
        protected string $name,
        protected string $description,
        protected Coin $sellValue,
        protected WeaponType $type,
        protected Damage $damage,
        protected WeaponMastery $requiredWeaponMastery,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getSellValue(): Coin
    {
        return $this->sellValue;
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
