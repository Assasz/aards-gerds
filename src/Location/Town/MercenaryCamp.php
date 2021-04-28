<?php

declare(strict_types=1);

namespace AardsGerds\Game\Location\Town;

use AardsGerds\Game\Entity\Human\Mefadriel;
use AardsGerds\Game\Location\Location;
use AardsGerds\Game\Location\VisitorCollection;
use AardsGerds\Game\Location\VisitorRole;

final class MercenaryCamp extends Location
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
