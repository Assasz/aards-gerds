<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Generic;

use AardsGerds\Game\Event\Decision;
use AardsGerds\Game\Event\DialogEvent;
use AardsGerds\Game\Event\Event;

final class DialogDecision implements Decision
{
    public function __construct(
        private DialogEvent $event,
    ) {}

    public function __invoke(): Event
    {
        return $this->event;
    }

    public function __toString(): string
    {
        return "Talk to {$this->event->getSubject()->getName()}";
    }
}
