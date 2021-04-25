<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory;

use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

interface Usable extends \Stringable
{
    public function use(Player $player, PlayerAction $playerAction): void;
}
