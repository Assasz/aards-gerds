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
        return <<<'EOT'
        As you came closer to the fireplace you noticed a man in heavy armor, staring at the flames without any movement.
        A lot of empty bottles lays beneath his legs.
        EOT;
    }
}
