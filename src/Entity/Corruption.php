<?php

declare(strict_types=1);

namespace AardsGerds\Game\Entity;

use AardsGerds\Game\Shared\IntegerValue;
use AardsGerds\Game\Shared\IntegerValueException;

final class Corruption extends IntegerValue
{
    public static function low(): self
    {
        return new self(1);
    }

    public static function medium(): self
    {
        return new self(2);
    }

    public static function high(): self
    {
        return new self(3);
    }

    public function __toString(): string
    {
        return match ($this->value) {
            1 => 'low',
            2 => 'medium',
            3 => 'high',
            default => throw IntegerValueException::invalidValue($this->value),
        };
    }

    protected function validate(): void
    {
        if (!in_array($this->value, [1, 2, 3])) {
            throw IntegerValueException::invalidValue($this->value);
        }
    }
}
