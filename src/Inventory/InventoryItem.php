<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory;

abstract class InventoryItem
{
    public function __construct(
        protected string $name,
        protected string $description,
        protected Coin $sellValue,
        protected Coin $buyValue,
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

    public function getBuyValue(): Coin
    {
        return $this->buyValue;
    }
}
