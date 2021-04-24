<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Attribute;

use AardsGerds\Game\Shared\IntegerValue;
use AardsGerds\Game\Shared\IntegerValueException;

final class Health extends IntegerValue
{
    protected function validate(): void
    {
        if ($this->value < 1) {
            throw IntegerValueException::invalidValue($this->value);
        }
    }
}
