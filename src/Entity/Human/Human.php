<?php

declare(strict_types=1);

namespace AardsGerds\Game\Entity\Human;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Inventory\Weapon\Weapon;
use AardsGerds\Game\Fight\Fighter;

abstract class Human implements Fighter
{
    public function __construct(
        protected string $name,
        protected Health $health,
        protected Etherum $etherum,
        protected Strength $strength,
        protected TalentCollection $talentCollection,
        protected ?Weapon $weapon,
    ) {}

    public function getHealth(): Health
    {
        return $this->health;
    }

    public function getEtherum(): Etherum
    {
        return $this->etherum;
    }

    public function getStrength(): Strength
    {
        return $this->strength;
    }

    public function getWeaponMasteryLevel(): WeaponMasteryLevel
    {
        if ($this->weapon === null) {
            return WeaponMasteryLevel::inexperienced();
        }

        $weaponMastery = $this->talentCollection->findWeaponMasteryForWeaponType($this->weapon->getType());
        if ($weaponMastery === null) {
            return WeaponMasteryLevel::inexperienced();
        }

        return $weaponMastery->getLevel();
    }

    public function getWeapon(): ?Weapon
    {
        return $this->weapon;
    }
}