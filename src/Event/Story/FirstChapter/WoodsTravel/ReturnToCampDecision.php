<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\WoodsTravel;

use AardsGerds\Game\Event\Decision;
use AardsGerds\Game\Event\Event;
use AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp\MercenaryCampVisitEvent;

final class ReturnToCampDecision implements Decision
{
    public function __invoke(): Event
    {
        return new MercenaryCampVisitEvent();
    }

    public function __toString(): string
    {
        return 'Return to camp';
    }
}
