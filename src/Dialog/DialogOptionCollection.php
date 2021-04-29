<?php

declare(strict_types=1);

namespace AardsGerds\Game\Dialog;

use AardsGerds\Game\Shared\Collection;

final class DialogOptionCollection extends Collection
{
    protected function getType(): string
    {
        return DialogOption::class;
    }
}
