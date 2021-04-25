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

    public function remove(InventoryItem $item): self
    {
        $this->items = $this->filter(
            static fn(InventoryItem $inventoryItem): bool => $inventoryItem !== $item,
        )->getItems();

        return $this;
    }

    protected function getType(): string
    {
        return InventoryItem::class;
    }
}
