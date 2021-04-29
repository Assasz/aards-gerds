<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\WoodsTravel;

use AardsGerds\Game\Event\Decision\DecisionCollection;
use AardsGerds\Game\Event\Decision\VisitDecision;
use AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp\MercenaryCampVisitEvent;
use AardsGerds\Game\Event\TravelEvent;

final class WoodsTravelEvent extends TravelEvent
{
    public function __construct()
    {
        parent::__construct(
            new WoodsTravelContext(),
            new DecisionCollection([
                new VisitDecision(new MercenaryCampVisitEvent()),
            ]),
        );
    }
}
