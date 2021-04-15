<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory;

interface InventoryItem
{
    public function getName(): string;

    public function getDescription(): string;

    public function getSellValue(): Coin;
}
