<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\Effect;

interface Effect
{
    public function getName(): string;

    public function getDescription(): string;
}
