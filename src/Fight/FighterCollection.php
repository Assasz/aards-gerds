<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Shared\Collection;
use function Lambdish\Phunctional\sort;

final class FighterCollection extends Collection
{
    public function order(): self
    {
        return new self(
            sort(
                static fn(Fighter $one, Fighter $another) =>
                    $another->getInitiative()->get() <=> $one->getInitiative()->get(),
                $this->items,
            ),
        );
    }

    protected function getType(): string
    {
        return Fighter::class;
    }
}
