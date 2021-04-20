<?php

declare(strict_types=1);

namespace AardsGerds\Game\Shared;

use function Lambdish\Phunctional\first;
use function Lambdish\Phunctional\all;
use function Lambdish\Phunctional\instance_of;

abstract class Collection implements \IteratorAggregate, \Countable
{
    protected array $items;

    final public function __construct(iterable $items)
    {
        $this->items = $items instanceof \Traversable ? iterator_to_array($items) : $items;
        $this->assertType();
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function filter(callable $filter): static
    {
        return new static(array_filter($this->items, $filter));
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->items);
    }

    abstract protected function getType(): string;

    private function assertType(): void
    {
        $type = $this->getType();

        if (!all(instance_of($type), $this->items)) {
            throw CollectionException::invalidType(get_class(first($this->items)), $type);
        }
    }
}
