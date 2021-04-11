<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\Effect;

final class BlockImmunity implements Effect
{
    public function getName(): string
    {
        return 'Block Immunity';
    }

    public function getDescription(): string
    {
        return 'This attack cannot be blocked.';
    }
}
