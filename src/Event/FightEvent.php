<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Entity\Entity;
use AardsGerds\Game\Fight\Fight;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

abstract class FightEvent extends Event
{
    public function __construct(
        Context $context,
        DecisionCollection $decisionCollection,
        Player $player,
        protected Entity $subject,
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
        $playerAction->tell((string) $this->context);
        // fight!
        (new Fight($this->player, $this->subject))($playerAction);
        // travel, loot or dialog?
        return $playerAction->askForDecision('What is your decision?', $this->decisionCollection);
    }
}
