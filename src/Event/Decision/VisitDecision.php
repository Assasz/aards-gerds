<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Decision;

use AardsGerds\Game\Event\Event;
use AardsGerds\Game\Event\VisitEvent;

final class VisitDecision implements Decision
{
    public function __construct(
        private VisitEvent $event,
    ) {}

    public function __invoke(): Event
    {
        return $this->event;
    }

    public function __toString(): string
    {
        return "Go to {$this->event->getContext()->getLocation()}";
    }
}
