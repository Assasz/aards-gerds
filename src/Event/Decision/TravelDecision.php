<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Decision;

use AardsGerds\Game\Event\Event;
use AardsGerds\Game\Event\TravelEvent;

final class TravelDecision implements Decision
{
    public function __construct(
        private TravelEvent $event,
    ) {}

    public function __invoke(): Event
    {
        return $this->event;
    }

    public function __toString(): string
    {
        return 'Continue your travel';
    }
}
