<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Entity\EntityCollection;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

abstract class FightEvent extends Event
{
    public function __construct(
        Context $context,
        DecisionCollection $decisionCollection,
        Player $player,
        protected EntityCollection $subjects,
    ) {
        parent::__construct(
            EventType::fight(),
            $context,
            $decisionCollection,
            $player,
        );
    }

    public function __invoke(PlayerAction $playerAction): Decision
    {
        // fight!
        // travel, loot or dialog?
        return $playerAction->askForDecision('question', $this->decisionCollection);
    }
}
