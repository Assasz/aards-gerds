<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Weapon\ShortSword;

use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Shared\IntegerValue;

final class RustyShortSword extends ShortSword
{
    public function __construct()
    {
        parent::__construct(
            'Rusty Short Sword',
            new IntegerValue(10),
        );
    }

    public function getRequiredStrength(): Strength
    {
        return new Strength(5);
    }
}
