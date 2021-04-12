<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Weapon;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;

abstract class Weapon
{
    public function __construct(
        protected string $name,
        protected WeaponType $type,
        protected Damage $damage,
        protected Strength $requiredStrength,
        protected WeaponMastery $requiredWeaponMastery,
    ) {}

    public function getType(): WeaponType
    {
        return $this->type;
    }

    public function getDamage(): Damage
    {
        return $this->damage;
    }
}
