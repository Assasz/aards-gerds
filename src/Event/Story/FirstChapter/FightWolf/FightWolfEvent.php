<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\FightWolf;

use AardsGerds\Game\Entity\Beast\Animal\Wolf;
use AardsGerds\Game\Entity\EntityCollection;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Event\DecisionCollection;
use AardsGerds\Game\Event\FightEvent;

final class FightWolfEvent extends FightEvent
{
    public function __construct(Player $player, Wolf $wolf)
    {
        parent::__construct(
            new FightWolfContext(),
            new DecisionCollection([
                new LootWolfDecision($player, $wolf),
            ]),
            $player,
            new EntityCollection([$wolf]),
        );
    }
}
