<?php

declare(strict_types=1);

namespace AardsGerds\Game\Shared;

final class IntegerValueException extends \RuntimeException
{
    public static function invalidValue(int $value): self
    {
        return new self("{$value} is not a valid value");
    }
}
