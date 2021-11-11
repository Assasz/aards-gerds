<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Shared\Collection;
use function Lambdish\Phunctional\sort;

final class FighterCollection extends Collection
{
    public function orderByInitiative(): self
    {
        return new self(
            sort(
                static fn(Fighter $one, Fighter $another) =>
                    $another->getInitiative()->get() <=> $one->getInitiative()->get(),
                $this->items,
            ),
        );
    }

    public function first(): Fighter
    {
        $this->makeSureNotEmpty();

        return $this->getIterator()->current();
    }

    protected function getType(): string
    {
        return Fighter::class;
    }
}
