<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\Effect;

final class BlockImmunity implements Effect
{
    public static function getName(): string
    {
        return 'Block Immunity';
    }

    public static function getDescription(): string
    {
        return 'This attack cannot be blocked.';
    }
}
