<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Inventory\Weapon\Weapon;

interface MeleeAttack extends Attack
{
    public function getDamage(Weapon $weapon): Damage;
}
