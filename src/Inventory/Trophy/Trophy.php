<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Trophy;

use AardsGerds\Game\Inventory\Coin;
use AardsGerds\Game\Inventory\InventoryItem;

abstract class Trophy extends InventoryItem
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
