<?php

declare(strict_types=1);

namespace AardsGerds\Game\Entity\Human;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Initiative;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Entity\Entity;
use AardsGerds\Game\Inventory\Alchemy\Potion\HealthPotion;
use AardsGerds\Game\Inventory\Inventory;
use AardsGerds\Game\Inventory\Weapon\GreatSword\SteelFromAbyss;
use AardsGerds\Game\Inventory\Weapon\ShortSword\RustyShortSword;

final class Tufus extends Entity
{
    public function __construct()
    {
        parent::__construct(
            'Tufus',
            new Health(500),
            new Etherum(1),
            new Strength(80),
            new Initiative(10),
            new TalentCollection([]),
            new Inventory([
                new SteelFromAbyss(),
                new HealthPotion(),
                new HealthPotion(),
            ]),
            new RustyShortSword(),
        );
    }
}
