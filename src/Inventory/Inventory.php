<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory;

use AardsGerds\Game\Shared\Collection;

final class Inventory extends Collection
{
    public function filterUsable(): self
    {
        return $this->filter(
            static fn(InventoryItem $inventoryItem): bool => $inventoryItem instanceof Usable,
        );
    }

    protected function getType(): string
    {
        return InventoryItem::class;
    }
}
