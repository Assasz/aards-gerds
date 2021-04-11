<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Build\Talent\Effect\EffectCollection;
use AardsGerds\Game\Shared\IntegerValue;

interface Attack
{
    public function getDamage(): IntegerValue;

    public function getEffects(): EffectCollection;
}
