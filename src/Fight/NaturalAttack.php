<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Build\Attribute\Damage;

interface NaturalAttack extends Attack
{
    public function getDamage(): Damage;
}
