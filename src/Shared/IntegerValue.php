<?php

declare(strict_types=1);

namespace AardsGerds\Game\Shared;

class IntegerValue implements \Stringable
{
    final public function __construct(
        protected int $value,
    ) {
        $this->validate();
    }

    public function get(): int
    {
        return $this->value;
    }

    public function equals(self $value): bool
    {
        return $this->value === $value->get();
    }

    public function isGreaterThan(self $value): bool
    {
        return $this->value > $value->get();
    }

    public function isGreaterThanOrEqual(self $value): bool
    {
        return $this->value >= $value->get();
    }

    public function diff(self $value): static
    {
        return new static(abs($this->value - $value->get()));
    }

    public function increment(): static
    {
        $this->value += 1;

        return $this;
    }

    public function increaseBy(self $value): static
    {
        $this->value += $value->get();

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    protected function validate(): void
    {
        if ($this->value < 0) {
            throw IntegerValueException::onlyPositive();
        }
    }
}
