<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp;

use AardsGerds\Game\Event\Context;
use AardsGerds\Game\Event\Story\Location;

final class MercenaryCampVisitContext implements Context
{
    public function getLocation(): Location
    {
        return Location::mercenaryCamp();
    }

    public function __toString(): string
    {
        return 'You have returned to camp.';
    }
}
