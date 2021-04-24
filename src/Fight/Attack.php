<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Build\Talent\Effect\EffectCollection;

interface Attack extends \Stringable
{
    public function getEffects(): EffectCollection;
}
