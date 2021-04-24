<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Alchemy\Potion;

use AardsGerds\Game\Inventory\Coin;
use AardsGerds\Game\Inventory\InventoryItem;
use AardsGerds\Game\Inventory\Usable;

abstract class Potion extends InventoryItem implements Usable
{
    public function __construct(
        string $name,
        string $description,
        Coin $sellValue,
        Coin $buyValue,
    ) {
        parent::__construct($name, $description, $sellValue, $buyValue);
    }
}
