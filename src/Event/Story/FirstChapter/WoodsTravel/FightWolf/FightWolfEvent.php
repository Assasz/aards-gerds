<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\WoodsTravel\FightWolf;

use AardsGerds\Game\Build\Experience;
use AardsGerds\Game\Entity\Beast\Animal\Wolf;
use AardsGerds\Game\Entity\EntityCollection;
use AardsGerds\Game\Event\DecisionCollection;
use AardsGerds\Game\Event\FightEvent;

final class FightWolfEvent extends FightEvent
{
    public function __construct(Wolf $wolf)
    {
        parent::__construct(
            new FightWolfContext(),
            new DecisionCollection([
                new LootWolfDecision($wolf),
                new ContinueTravelDecision(),
            ]),
            new EntityCollection([$wolf]),
            new Experience(200),
        );
    }
}
