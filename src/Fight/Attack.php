<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Talent\Effect\EffectCollection;

interface Attack
{
    public function getDamage(): Damage;

    public function getEffects(): EffectCollection;
}
