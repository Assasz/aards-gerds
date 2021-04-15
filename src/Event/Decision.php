<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Shared\IntegerValue;

abstract class Decision implements \Stringable
{
    public function __construct(
        protected IntegerValue $order,
        protected Player $player,
    ) {}

    public function getOrder(): IntegerValue
    {
        return $this->order;
    }

    abstract public function __invoke(): Event;
}
