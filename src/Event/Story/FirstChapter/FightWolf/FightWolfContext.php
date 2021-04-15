<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\FightWolf;

use AardsGerds\Game\Event\Context;

final class FightWolfContext implements Context
{
    public function __toString(): string
    {
        return 'You are about to beat the shit out of the wolf.';
    }
}
