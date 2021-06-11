<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp\VisitBlacksmith;

use AardsGerds\Game\Event\Context;
use AardsGerds\Game\Event\Story\Location;

final class BlacksmithDialogContext implements Context
{
    public function getLocation(): Location
    {
        return Location::mercenaryCamp();
    }

    public function __toString(): string
    {
        return 'Yolo';
    }
}
