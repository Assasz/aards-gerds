<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\WoodsTravel\FightWolf;

use AardsGerds\Game\Entity\Beast\Animal\Wolf;
use AardsGerds\Game\Event\Decision;
use AardsGerds\Game\Event\Event;
use AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp\MercenaryCampVisitEvent;

final class LootWolfDecision implements Decision
{
    public function __construct(
        private Wolf $wolf,
    ) {}

    public function __invoke(): Event
    {
        return new MercenaryCampVisitEvent(); // todo: change event
    }

    public function __toString(): string
    {
        return 'Loot wolf';
    }
}
