<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory;

use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

interface Consumable extends \Stringable
{
    public function consume(Player $player, PlayerAction $playerAction): void;
}
