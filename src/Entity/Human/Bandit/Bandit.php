<?php

declare(strict_types=1);

namespace AardsGerds\Game\Entity\Human\Bandit;

use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Build\Talent\WeaponMastery\ShortSword\Novice\Slash;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Entity\Human\Human;
use AardsGerds\Game\Inventory\Weapon\ShortSword\RustyShortSword;

final class Bandit extends Human
{
    public function __construct()
    {
        $weapon = new RustyShortSword();

        parent::__construct(
            'Bandit',
            new Health(100),
            new Strength(20),
            new TalentCollection([
                WeaponMastery::shortSword(WeaponMasteryLevel::novice()),
                new Slash($weapon),
            ]),
            $weapon,
        );
    }
}
