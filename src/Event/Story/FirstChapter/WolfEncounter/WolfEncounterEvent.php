<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\WolfEncounter;

use AardsGerds\Game\Entity\Beast\Animal\Wolf;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Shared\IntegerValue;
use AardsGerds\Game\Event\DecisionCollection;
use AardsGerds\Game\Event\EncounterEvent;
use AardsGerds\Game\Event\Story\FirstChapter\FightWolf\FightWolfDecision;

final class WolfEncounterEvent extends EncounterEvent
{
    public function __construct(Player $player)
    {
        $subject = new Wolf();

        parent::__construct(
            new WolfEncounterContext(),
            new DecisionCollection([
                new FightWolfDecision(new IntegerValue(1), $player, $subject),
            ]),
            $player,
            $subject,
        );
    }
}
