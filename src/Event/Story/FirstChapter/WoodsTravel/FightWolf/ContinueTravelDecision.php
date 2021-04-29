<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\WoodsTravel\FightWolf;

use AardsGerds\Game\Event\Decision;
use AardsGerds\Game\Event\Event;
use AardsGerds\Game\Event\Story\FirstChapter\WoodsTravel\WoodsTravelEvent;

final class ContinueTravelDecision implements Decision
{
    public function __invoke(): Event
    {
        return new WoodsTravelEvent();
    }

    public function __toString(): string
    {
        return 'Continue your travel';
    }
}
