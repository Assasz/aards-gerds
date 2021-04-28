<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp;

use AardsGerds\Game\Event\DecisionCollection;
use AardsGerds\Game\Event\VisitEvent;
use AardsGerds\Game\Location\Town\MercenaryCamp;

final class MercenaryCampVisitEvent extends VisitEvent
{
    public function __construct()
    {
        parent::__construct(
            new MercenaryCampVisitContext(),
            new DecisionCollection([]),
            new MercenaryCamp(),
        );
    }
}
