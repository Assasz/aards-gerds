<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Alchemy\Potion;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Inventory\Coin;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

final class EtherumPotion extends Potion
{
    public function __construct()
    {
        parent::__construct(
            'Etherum Potion',
            'Alcohol solution with little Etherum in it. 
            This potion will grant you 1 Etherum, or kill you if you underestimate it.',
            new Coin(100),
            new Coin(200),
        );
    }

    public function consume(Player $player, PlayerAction $playerAction): void
    {
        $player->increaseEtherum(new Etherum(1));
        $player->getInventory()->remove($this);

        $playerAction->tell('Whoah, what the heck was that...');
    }
}
