<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Decision;

use AardsGerds\Game\Event\Event;
use AardsGerds\Game\Event\FightEvent;

final class LootDecision implements Decision
{
    public function __construct(
        private FightEvent $event, // todo: change this
    ) {}

    public function __invoke(): Event
    {
        return $this->event;
    }

    public function __toString(): string
    {
        return "Loot";
    }
}
