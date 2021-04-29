<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp\MeetMefadriel;

use AardsGerds\Game\Event\Context;
use AardsGerds\Game\Event\Story\Location;

final class MefadrielDialogContext implements Context
{
    public function getLocation(): Location
    {
        return Location::mercenaryCamp();
    }

    public function __toString(): string
    {
        return 'mefadriel-dialog-context';
    }
}
