<?php

declare(strict_types=1);

namespace AardsGerds\Game\Location\Town;

use AardsGerds\Game\Entity\Human\Mefadriel;

final class MercenaryCamp extends Town
{
    public function __construct()
    {
        parent::__construct(
            'Mercenary Camp',
            new VisitorCollection([
                new Mefadriel(VisitorRole::questGiver()),
            ]),
        );
    }
}
