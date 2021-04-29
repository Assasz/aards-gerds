<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Entity\Entity;
use AardsGerds\Game\Event\Decision\Decision;
use AardsGerds\Game\Event\Decision\DecisionCollection;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

abstract class EncounterEvent extends Event
{
    public function __construct(
        Context $context,
        DecisionCollection $decisionCollection,
        protected Entity $subject,
    ) {
        parent::__construct(
            $context,
            $decisionCollection,
        );
    }

    public function __invoke(Player $player, PlayerAction $playerAction): Decision
    {
        $playerAction->introduce((string) $this->context->getLocation());
        // dialog, travel, fight or retreat?
        return $playerAction->askForDecision((string) $this->context, $this->decisionCollection);
    }
}
