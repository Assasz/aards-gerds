<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\FightWolf;

use AardsGerds\Game\Entity\Beast\Animal\Wolf;
use AardsGerds\Game\Event\Decision;
use AardsGerds\Game\Event\Event;
use AardsGerds\Game\Player\Player;

final class LootWolfDecision extends Decision
{
    public function __construct(
        Player $player,
        private Wolf $wolf,
    ) {
        parent::__construct($player);
    }

    public function __invoke(): Event
    {
        return new FightWolfEvent($this->player, $this->wolf); // todo: change event
    }

    public function __toString()
    {
        return 'Loot wolf';
    }
}
