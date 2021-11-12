<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory;

use AardsGerds\Game\Shared\Collection;

final class Inventory extends Collection
{
    public function filterConsumable(): self
    {
        return $this->filter(
            static fn(InventoryItem $inventoryItem): bool => $inventoryItem instanceof Consumable,
        );
    }

    /**
     * @note This method mutates state of the collection
     */
    public function add(InventoryItem $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @note This method mutates state of the collection
     */
    public function addMany(InventoryItem ...$items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @note This method mutates state of the collection
     */
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
