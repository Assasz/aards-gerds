<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\WoodsTravel\WolfEncounter;

use AardsGerds\Game\Entity\Beast\Animal\Wolf;
use AardsGerds\Game\Event\DecisionCollection;
use AardsGerds\Game\Event\EncounterEvent;

final class WolfEncounterEvent extends EncounterEvent
{
    public function __construct()
    {
        $subject = new Wolf();

        parent::__construct(
            new WolfEncounterContext(),
            new DecisionCollection([
                new FightWolfDecision($subject),
            ]),
            $subject,
        );
    }
}
