<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\WoodsTravel\WolfEncounter;

use AardsGerds\Game\Event\Context;
use AardsGerds\Game\Event\Location;

final class WolfEncounterContext implements Context
{
    public function getLocation(): Location
    {
        return Location::darkWoods();
    }

    public function __toString(): string
    {
        return "Big wolf is hiding in the woods nearby. Definitely he's looking for its prey.";
    }
}
