<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Entity\Entity;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

abstract class EncounterEvent extends Event
{
    public function __construct(
        Context $context,
        DecisionCollection $decisionCollection,
        Player $player,
        protected Entity $subject,
    ) {
        parent::__construct(
            EventType::encounter(),
            $context,
            $decisionCollection,
            $player,
        );
    }

    public function __invoke(PlayerAction $playerAction): Decision
    {
        // dialog, travel, fight or retreat?
        return $playerAction->askForDecision((string) $this->context, $this->decisionCollection);
    }
}
