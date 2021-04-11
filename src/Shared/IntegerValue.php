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

    public function advantage(self $value): int
    {
        $difference = $this->value - $value->get();

        return $difference > 0 ? $difference : 0;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
