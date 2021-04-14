<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\Effect;

final class Stun implements Effect
{
    public static function getName(): string
    {
        return 'Stun';
    }

    public static function getDescription(): string
    {
        return 'This attack stuns opponent for 1 round.';
    }
}
