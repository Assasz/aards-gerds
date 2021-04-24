<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Shared\Collection;
use function Lambdish\Phunctional\first;
use function Lambdish\Phunctional\last;
use function Lambdish\Phunctional\sort;

final class AttackOrder extends Collection
{
    public static function resolve(Fighter ...$fighters): self
    {
        return new self(
            sort(
                static fn(Fighter $one, Fighter $another) =>
                    $one->getInitiative()->get() <=> $another->getInitiative()->get(),
                $fighters,
            ),
        );
    }

    public function first(): Fighter
    {
        return first($this->items);
    }

    public function last(): Fighter
    {
        return last($this->items);
    }

    protected function getType(): string
    {
        return Fighter::class;
    }
}
