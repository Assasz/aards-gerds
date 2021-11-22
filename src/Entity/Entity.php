<?php

declare(strict_types=1);

namespace AardsGerds\Game\Entity;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Initiative;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\SecretKnowledge\Ascension;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Fight\Fighter;
use AardsGerds\Game\Inventory\Inventory;
use AardsGerds\Game\Inventory\Weapon\Weapon;
use AardsGerds\Game\Shared\IntegerValueException;

abstract class Entity implements Fighter
{
    public function __construct(
        protected string $name,
        protected Health $health,
        protected Etherum $etherum,
        protected Strength $strength,
        protected Initiative $initiative,
        protected TalentCollection $talentCollection,
        protected Inventory $inventory,
        protected ?Weapon $weapon = null,
        protected ?Corruption $corruption = null,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

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

    public function getInitiative(): Initiative
    {
        return $this->initiative;
    }

    public function getTalents(): TalentCollection
    {
        return $this->talentCollection;
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

    public function getInventory(): Inventory
    {
        return $this->inventory;
    }

    public function getWeapon(): ?Weapon
    {
        return $this->weapon;
    }

    public function hasWeapon(): bool
    {
        return $this->weapon !== null;
    }

    public function getCorruption(): ?Corruption
    {
        return $this->corruption;
    }

    public function isCorrupted(): bool
    {
        return $this->corruption !== null;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    protected function calculateCorruptionBoundary(): Etherum
    {
        $ascension = $this->talentCollection->findSecretKnowledge()?->getAscension();
        if ($ascension === null) {
            return new Etherum(2);
        }

        try {
            $nextAscensionEtherum = (new Ascension($ascension->get()))->increment()->getRequiredEtherum();
        } catch (IntegerValueException) {
            // entity has 8th ascension
            $nextAscensionEtherum = new Etherum(Ascension::eighthAscension()->getRequiredEtherum()->get() * 2);
        }

        // etherum required by next ascension + 0.5 x etherum required by next ascension
        return $nextAscensionEtherum->increaseBy(
            new Etherum((int) ($nextAscensionEtherum->get() * 0.5)),
        );
    }
}
