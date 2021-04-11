<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Weapon;

use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Shared\IntegerValue;

abstract class Weapon
{
    public function __construct(
        protected string $name,
        protected WeaponType $type,
        protected IntegerValue $damage,
        protected Strength $requiredStrength,
        protected WeaponMastery $requiredWeaponMastery,
    ) {}

    public function getType(): WeaponType
    {
        return $this->type;
    }

    public function getDamage(): IntegerValue
    {
        return $this->damage;
    }
}
