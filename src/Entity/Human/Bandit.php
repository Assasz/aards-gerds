<?php

declare(strict_types=1);

namespace AardsGerds\Game\Entity\Human;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Initiative;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Build\Talent\WeaponMastery\ShortSword\Novice\Slash;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Entity\Entity;
use AardsGerds\Game\Inventory\Inventory;
use AardsGerds\Game\Inventory\Weapon\ShortSword\RustyShortSword;

final class Bandit extends Entity
{
    public function __construct()
    {
        parent::__construct(
            'Bandit',
            new Health(100),
            new Etherum(1),
            new Strength(20),
            new Initiative(10),
            new TalentCollection([
                WeaponMastery::shortSword(WeaponMasteryLevel::novice()),
                new Slash(),
            ]),
            new Inventory([]),
            new RustyShortSword(),
        );
    }
}
