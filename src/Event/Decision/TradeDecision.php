<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Decision;

use AardsGerds\Game\Event\Event;
use AardsGerds\Game\Event\TradeEvent;

final class TradeDecision implements Decision
{
    public function __construct(
        private TradeEvent $event,
    ) {}

    public function __invoke(): Event
    {
        return $this->event;
    }

    public function __toString(): string
    {
        return 'Trade';
    }
}
