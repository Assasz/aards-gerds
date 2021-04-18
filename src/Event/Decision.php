<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Player\Player;

abstract class Decision implements \Stringable
{
    public function __construct(
        protected Player $player,
    ) {}

    abstract public function __invoke(): Event;
}
