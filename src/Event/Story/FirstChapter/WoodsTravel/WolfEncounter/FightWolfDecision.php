<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\WoodsTravel\WolfEncounter;

use AardsGerds\Game\Entity\Beast\Animal\Wolf;
use AardsGerds\Game\Event\Decision;
use AardsGerds\Game\Event\Story\FirstChapter\WoodsTravel\FightWolf\FightWolfEvent;
use AardsGerds\Game\Event\Event;

final class FightWolfDecision implements Decision
{
    public function __construct(
        private Wolf $wolf,
    ) {}

    public function __invoke(): Event
    {
        return new FightWolfEvent($this->wolf);
    }

    public function __toString(): string
    {
        return "Attack wolf";
    }
}
