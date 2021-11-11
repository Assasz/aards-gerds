<?php

declare(strict_types=1);

namespace AardsGerds\Game\Entity\Nameless;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Initiative;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\SecretKnowledge\Ascension;
use AardsGerds\Game\Build\Talent\SecretKnowledge\SecretKnowledge;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Build\Talent\WeaponMastery\ShortSword\Novice\Slash;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Entity\Entity;
use AardsGerds\Game\Inventory\Inventory;
use AardsGerds\Game\Inventory\Weapon\GreatSword\SteelFromAbyss;

final class Nameless extends Entity
{
    public function __construct()
    {
        parent::__construct(
            'Nameless',
            new Health(500),
            new Etherum(rand(2, 10)),
            new Strength(100),
            new Initiative(40),
            new TalentCollection([
                WeaponMastery::greatSword(WeaponMasteryLevel::veteran()),
                new SecretKnowledge(Ascension::sixthAscension()),
                new Slash(),
            ]),
            new Inventory([]),
            new SteelFromAbyss(),
            true,
        );
    }
}
