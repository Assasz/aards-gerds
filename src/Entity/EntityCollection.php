<?php

declare(strict_types=1);

namespace AardsGerds\Game\Entity;

use AardsGerds\Game\Shared\Collection;

final class EntityCollection extends Collection
{
    protected function getType(): string
    {
        return Entity::class;
    }
}
