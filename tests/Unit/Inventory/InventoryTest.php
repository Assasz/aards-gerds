<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Unit\Inventory;

use AardsGerds\Game\Inventory\Alchemy\Potion\Potion;
use AardsGerds\Game\Inventory\Inventory;
use AardsGerds\Game\Inventory\InventoryItem;
use AardsGerds\Game\Inventory\Weapon\Weapon;
use PHPUnit\Framework\TestCase;

final class InventoryTest extends TestCase
{
    /** @test */
    public function canAddItem(): void
    {
        $inventory = new Inventory([]);
        $inventory->add($this->createMock(InventoryItem::class));

        self::assertCount(1, $inventory);
    }

    /** @test */
    public function canAddManyItems(): void
    {
        $inventory = new Inventory([]);
        $inventory->addMany($this->createMock(InventoryItem::class), $this->createMock(InventoryItem::class));

        self::assertCount(2, $inventory);
    }

    /** @test */
    public function canRemoveItem(): void
    {
        $item = $this->createMock(InventoryItem::class);
        $inventory = new Inventory([$item]);

        self::assertCount(1, $inventory);

        $inventory->remove($item);

        self::assertCount(0, $inventory);
    }

    /** @test */
    public function filtersConsumableItems(): void
    {
        $inventory = new Inventory([
            $this->createMock(Weapon::class),
            $this->createMock(Potion::class),
            $this->createMock(Potion::class),
        ]);

        self::assertCount(2, $inventory->filterConsumable());
    }
}
