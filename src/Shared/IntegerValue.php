<?php

declare(strict_types=1);

namespace AardsGerds\Game\Shared;

class IntegerValue implements \Stringable
{
    public function __construct(
        protected int $value,
    ) {}

    public function get(): int
    {
        return $this->value;
    }

    public function diff(self $value): int
    {
        return $this->value - $value->get();
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
