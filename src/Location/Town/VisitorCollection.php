<?php

declare(strict_types=1);

namespace AardsGerds\Game\Location\Town;

use AardsGerds\Game\Shared\Collection;

final class VisitorCollection extends Collection
{
    protected function getType(): string
    {
        return Visitor::class;
    }
}
