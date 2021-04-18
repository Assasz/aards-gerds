<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

abstract class Event
{
    public function __construct(
        protected EventType $eventType,
        protected Context $context,
        protected DecisionCollection $decisionCollection,
        protected Player $player,
    ) {}

    abstract public function __invoke(PlayerAction $playerAction): Decision;
}
