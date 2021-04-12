<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Weapon\ShortSword;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Attribute\Strength;

final class RustyShortSword extends ShortSword
{
    public function __construct()
    {
        parent::__construct(
            'Rusty Short Sword',
            new Damage(10),
            new Strength(5),
        );
    }
}
