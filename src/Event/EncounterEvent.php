<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Entity\Entity;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Shared\IntegerValue;

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

    public function __invoke(): Decision
    {
        // dialog, travel, fight or retreat?
        $decision = $this->decisionCollection->findByOrder(new IntegerValue(1));
        assert($decision !== null);

        return $decision;
    }
}
