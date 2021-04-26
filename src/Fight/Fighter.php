<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Initiative;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Inventory\Weapon\Weapon;

interface Fighter extends \Stringable
{
    public function getName(): string;

    public function getHealth(): Health;

    public function getEtherum(): Etherum;

    public function getStrength(): Strength;

    public function getInitiative(): Initiative;

    public function getTalents(): TalentCollection;

    public function getWeaponMasteryLevel(): WeaponMasteryLevel;

    public function getWeapon(): ?Weapon;
}
