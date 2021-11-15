<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\WoodsTravel\FightWolf;

use AardsGerds\Game\Event\Context;
use AardsGerds\Game\Event\Location;

final class FightWolfContext implements Context
{
    public function getLocation(): Location
    {
        return Location::darkWoods();
    }

    public function __toString(): string
    {
        return 'You are about to beat the shit out of the wolf.';
    }
}
