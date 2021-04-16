<?php

declare(strict_types=1);

namespace AardsGerds\Game\Entity;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Strength;
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
        protected TalentCollection $talentCollection,
        protected Inventory $inventory,
        protected ?Weapon $weapon,
        protected bool $corrupted = false,
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

    public function getWeapon(): ?Weapon
    {
        return $this->weapon;
    }

    public function isCorrupted(): bool
    {
        return $this->corrupted;
    }

    public function calculateCorruptionBoundary(): Etherum
    {
        $ascension = $this->talentCollection->findSecretKnowledge()?->getAscension();
        if ($ascension === null) {
            return new Etherum(2);
        }

        try {
            $nextAscensionEtherum = $ascension->increment()->getRequiredEtherum();
        } catch (IntegerValueException $exception) {
            // entity has 8th ascension
            $nextAscensionEtherum = new Etherum($ascension->getRequiredEtherum()->get() * 2);
        }

        // etherum required by next ascension + 0.5 x etherum required by next ascension
        return $nextAscensionEtherum->increaseBy(
            new Etherum((int) ($nextAscensionEtherum->get() * 0.5)),
        );
    }
}
