<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Shared\Collection;
use AardsGerds\Game\Shared\IntegerValue;

final class DecisionCollection extends Collection
{
    public function findByOrder(IntegerValue $order): ?Decision
    {
        return $this->filter(
            static fn(Decision $decision): bool => $decision->getOrder()->equals($order),
        )->getIterator()->current();
    }

    protected function getType(): string
    {
        return Decision::class;
    }
}
