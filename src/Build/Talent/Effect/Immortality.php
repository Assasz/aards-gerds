<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\Effect;

final class Immortality implements Effect
{
    public static function getName(): string
    {
        return 'Immortality';
    }

    public static function getDescription(): string
    {
        return 'Grants immortality. Only rebredir can break this power.';
    }
}
