<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\FightWolf;

use AardsGerds\Game\Entity\Beast\Animal\Wolf;
use AardsGerds\Game\Event\Decision;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Shared\IntegerValue;
use AardsGerds\Game\Event\Event;

final class FightWolfDecision extends Decision
{
    public function __construct(
        IntegerValue $order,
        Player $player,
        protected Wolf $wolf,
    ) {
        parent::__construct($order, $player);
    }

    public function getResult(): Event
    {
        return new FightWolfEvent($this->player, $this->wolf);
    }

    public function __toString(): string
    {
        return 'Attack wolf';
    }
}
