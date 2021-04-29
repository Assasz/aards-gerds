<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

abstract class VisitEvent extends Event
{
    public function __construct(
        Context $context,
        DecisionCollection $decisionCollection,
    ) {
        parent::__construct(
            $context,
            $decisionCollection,
        );
    }

    public function __invoke(Player $player, PlayerAction $playerAction): Decision
    {
        $player->setCheckpoint($this);
        $playerAction->savePlayerState($player);

        $playerAction->introduce((string) $this->context->getLocation());
        $playerAction->tell((string) $this->context);

        return $playerAction->askForDecision('Where do you want to go?', $this->decisionCollection);
    }
}
