<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Event\Decision\Decision;
use AardsGerds\Game\Event\Decision\DecisionCollection;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

abstract class Event
{
    public function __construct(
        protected Context $context,
        protected DecisionCollection $decisionCollection,
    ) {}

    abstract public function __invoke(Player $player, PlayerAction $playerAction): Decision;
}
