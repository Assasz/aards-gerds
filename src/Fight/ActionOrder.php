<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Shared\Collection;
use function Lambdish\Phunctional\sort;

final class ActionOrder extends Collection
{
    public static function resolve(Fighter ...$fighters): self
    {
        return new self(
            sort(
                static fn(Fighter $one, Fighter $another) =>
                    $another->getInitiative()->get() <=> $one->getInitiative()->get(),
                $fighters,
            ),
        );
    }

    protected function getType(): string
    {
        return Fighter::class;
    }
}
