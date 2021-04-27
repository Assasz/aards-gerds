<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp;

use AardsGerds\Game\Event\Context;

final class MercenaryCampVisitContext implements Context
{
    public function __toString(): string
    {
        return 'You have returned to camp.';
    }
}
