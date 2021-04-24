<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Alchemy\Potion;

use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Inventory\Coin;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

final class HealthPotion extends Potion
{
    public function __construct()
    {
        parent::__construct(
            'Health Potion',
            'This herbs combination will regenerate 40 health.',
            new Coin(20),
            new Coin(50),
        );
    }

    public function use(Player $player, PlayerAction $playerAction): void
    {
        // todo: player maximum health
        $player->getHealth()->increaseBy(new Health(40));
        $playerAction->tell('You feel better now.');
    }
}
