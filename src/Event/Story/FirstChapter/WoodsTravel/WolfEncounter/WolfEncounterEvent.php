<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\WoodsTravel\WolfEncounter;

use AardsGerds\Game\Entity\Beast\Animal\Wolf;
use AardsGerds\Game\Event\Decision\DecisionCollection;
use AardsGerds\Game\Event\Decision\FightDecision;
use AardsGerds\Game\Event\EncounterEvent;
use AardsGerds\Game\Event\Story\FirstChapter\WoodsTravel\FightWolf\FightWolfEvent;

final class WolfEncounterEvent extends EncounterEvent
{
    public function __construct()
    {
        $subject = new Wolf();

        parent::__construct(
            new WolfEncounterContext(),
            new DecisionCollection([
                new FightDecision(new FightWolfEvent($subject))
            ]),
            $subject,
        );
    }
}
