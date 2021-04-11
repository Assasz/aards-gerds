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
        protected IntegerValue $damage,
        protected WeaponType $type,
    ) {}

    public function getType(): WeaponType
    {
        return $this->type;
    }

    public function getDamage(): IntegerValue
    {
        return $this->damage;
    }

    abstract public function getRequiredStrength(): Strength;

    abstract public function getRequiredWeaponMastery(): WeaponMastery;
}
