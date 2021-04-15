<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Shared\IntegerValue;

abstract class TravelEvent extends Event
{
    public function __construct(
        Context $context,
        DecisionCollection $decisionCollection,
        Player $player,
    ) {
        parent::__construct(
            EventType::travel(),
            $context,
            $decisionCollection,
            $player,
        );
    }

    public function __invoke(): Decision
    {
        // travel, encounter or explore?
        $decision = $this->decisionCollection->findByOrder(new IntegerValue(1));
        assert($decision !== null);

        return $decision;
    }
}
