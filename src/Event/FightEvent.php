<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Entity\EntityCollection;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Shared\IntegerValue;

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

    public function __invoke(): Decision
    {
        // fight!
        // travel, loot or dialog?
        $decision = $this->decisionCollection->findByOrder(new IntegerValue(1));
        assert($decision !== null);

        return $decision;
    }
}
