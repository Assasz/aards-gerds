<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build;

use AardsGerds\Game\Shared\IntegerValue;

final class LevelProgress extends IntegerValue
{
    public function reset(): void
    {
        $this->value = 0;
    }
}
