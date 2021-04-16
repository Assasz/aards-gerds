<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Alchemy\Potion;

use AardsGerds\Game\Inventory\Coin;
use AardsGerds\Game\Inventory\InventoryItem;
use AardsGerds\Game\Player\Player;

abstract class Potion extends InventoryItem
{
    public function __construct(
        string $name,
        string $description,
        Coin $sellValue,
        Coin $buyValue,
    ) {
        parent::__construct($name, $description, $sellValue, $buyValue);
    }

    abstract public function drink(Player $player): void;
}
