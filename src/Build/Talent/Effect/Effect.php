<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\Effect;

interface Effect
{
    public static function getName(): string;

    public static function getDescription(): string;
}
