<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Trophy;

use AardsGerds\Game\Inventory\Coin;
use AardsGerds\Game\Inventory\InventoryItem;

abstract class Trophy implements InventoryItem
{
    public function __construct(
        protected string $name,
        protected string $description,
        protected Coin $sellValue,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getSellValue(): Coin
    {
        return $this->sellValue;
    }
}
