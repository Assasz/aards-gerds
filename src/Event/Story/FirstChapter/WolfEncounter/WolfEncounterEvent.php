<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\WolfEncounter;

use AardsGerds\Game\Entity\Beast\Animal\Wolf;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Event\DecisionCollection;
use AardsGerds\Game\Event\EncounterEvent;

final class WolfEncounterEvent extends EncounterEvent
{
    public function __construct(Player $player)
    {
        $subject = new Wolf();

        parent::__construct(
            new WolfEncounterContext(),
            new DecisionCollection([
                new FightWolfDecision($player, $subject),
            ]),
            $player,
            $subject,
        );
    }
}
