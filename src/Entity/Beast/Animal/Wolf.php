<?php

declare(strict_types=1);

namespace AardsGerds\Game\Entity\Beast\Animal;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Initiative;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\Natural\Bite;
use AardsGerds\Game\Build\Talent\Natural\DoubleClaw;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Entity\Entity;
use AardsGerds\Game\Inventory\Inventory;
use AardsGerds\Game\Inventory\Trophy\WolfFur;

final class Wolf extends Entity
{
    public function __construct()
    {
        parent::__construct(
            'Wolf',
            new Health(30),
            new Etherum(0),
            new Strength(5),
            new Initiative(10),
            new TalentCollection([new Bite(), new DoubleClaw()]),
            new Inventory([new WolfFur()]),
        );
    }
}
