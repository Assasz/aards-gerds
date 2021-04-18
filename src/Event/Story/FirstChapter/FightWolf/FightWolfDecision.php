<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\FightWolf;

use AardsGerds\Game\Entity\Beast\Animal\Wolf;
use AardsGerds\Game\Event\Decision;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Event\Event;

final class FightWolfDecision extends Decision
{
    public function __construct(
        Player $player,
        private Wolf $wolf,
    ) {
        parent::__construct($player);
    }

    public function __invoke(): Event
    {
        return new FightWolfEvent($this->player, $this->wolf);
    }

    public function __toString(): string
    {
        return "Attack wolf";
    }
}
