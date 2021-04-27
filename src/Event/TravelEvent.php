<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

abstract class TravelEvent extends Event
{
    public function __construct(
        Context $context,
        DecisionCollection $decisionCollection,
        Player $player,
    ) {
        parent::__construct(
            $context,
            $decisionCollection,
            $player,
        );
    }

    public function __invoke(PlayerAction $playerAction): Decision
    {
        // travel, encounter or explore?
        return $playerAction->askForDecision('question', $this->decisionCollection);
    }
}
