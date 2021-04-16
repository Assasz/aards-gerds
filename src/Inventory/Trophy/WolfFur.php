<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Trophy;

use AardsGerds\Game\Inventory\Coin;

final class WolfFur extends Trophy
{
    public function __construct()
    {
        parent::__construct(
            'Wolf Fur',
            'Some tanner surely will buy it.',
            new Coin(20),
            new Coin(40),
        );
    }
}
