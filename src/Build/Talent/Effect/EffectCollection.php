<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\Effect;

use AardsGerds\Game\Shared\Collection;

final class EffectCollection extends Collection
{
    public function has(string $effectName): bool
    {
        return $this->filter(
            static fn(Effect $effect): bool => $effect::getName() === $effectName,
        )->count() > 0;
    }

    protected function getType(): string
    {
        return Effect::class;
    }
}
