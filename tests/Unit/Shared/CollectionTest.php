<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Unit\Shared;

use AardsGerds\Game\Shared\Collection;
use AardsGerds\Game\Shared\CollectionException;
use PHPUnit\Framework\TestCase;

final class CollectionTest extends TestCase
{
    /** @test */
    public function assertsType(): void
    {
        $expectedException = CollectionException::invalidType(\ArrayObject::class, \stdClass::class);
        $this->expectException(get_class($expectedException));
        $this->expectExceptionMessage($expectedException->getMessage());

        $this->createCollection([new \ArrayObject()]);
    }

    /** @test */
    public function isTraversable(): void
    {
        $collection = $this->createCollection([new \stdClass()]);

        foreach ($collection as $item) {
            self::assertInstanceOf(\stdClass::class, $item);
        }
    }

    /** @test */
    public function createsFromTraversable(): void
    {
        $anotherCollection = $this->createCollection([new \stdClass()]);
        $collection = $this->createCollection($anotherCollection);

        self::assertInstanceOf(\stdClass::class, $collection->getIterator()->current());
    }

    /** @test */
    public function isCountable(): void
    {
        $collection = $this->createCollection([new \stdClass()]);

        self::assertCount(1, $collection);
    }

    /** @test */
    public function canBeValidatedToBeNotEmpty(): void
    {
        $expectedException = CollectionException::emptyCollection();
        $this->expectException(get_class($expectedException));
        $this->expectExceptionMessage($expectedException->getMessage());

        $collection = $this->createCollection([]);
        $collection->makeSureNotEmpty();
    }

    private function createCollection(iterable $items): Collection
    {
        return new class ($items) extends Collection {
            protected function getType(): string
            {
                return \stdClass::class;
            }
        };
    }
}
