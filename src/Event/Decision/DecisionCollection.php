<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Decision;

use AardsGerds\Game\Shared\Collection;

final class DecisionCollection extends Collection
{
    protected function getType(): string
    {
        return Decision::class;
    }
}
