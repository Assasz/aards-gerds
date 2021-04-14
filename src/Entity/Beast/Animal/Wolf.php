<?php

declare(strict_types=1);

namespace AardsGerds\Game\Entity\Beast\Animal;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Entity\Entity;

final class Wolf extends Entity
{
    public function __construct()
    {
        parent::__construct(
            'Wolf',
            new Health(50),
            new Etherum(1),
            new Strength(10),
            new TalentCollection([]),
            null,
        );
    }
}
