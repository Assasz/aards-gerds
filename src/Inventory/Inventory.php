<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory;

use AardsGerds\Game\Shared\Collection;

final class Inventory extends Collection
{
    protected function getType(): string
    {
        return InventoryItem::class;
    }
}
