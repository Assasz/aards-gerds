<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\WoodsTravel\FightWolf;

use AardsGerds\Game\Build\Experience;
use AardsGerds\Game\Entity\Beast\Animal\Wolf;
use AardsGerds\Game\Entity\EntityCollection;
use AardsGerds\Game\Event\Decision\DecisionCollection;
use AardsGerds\Game\Event\Decision\TravelDecision;
use AardsGerds\Game\Event\FightEvent;
use AardsGerds\Game\Event\Story\FirstChapter\WoodsTravel\WoodsTravelEvent;

final class FightWolfEvent extends FightEvent
{
    public function __construct(Wolf $wolf)
    {
        parent::__construct(
            new FightWolfContext(),
            new DecisionCollection([
                new TravelDecision(new WoodsTravelEvent()),
            ]),
            new EntityCollection([$wolf, new Wolf(), new Wolf()]),
            new Experience(200),
        );
    }
}
