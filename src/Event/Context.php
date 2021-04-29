<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Event\Story\Location;

interface Context extends \Stringable
{
    public function getLocation(): Location;
}
