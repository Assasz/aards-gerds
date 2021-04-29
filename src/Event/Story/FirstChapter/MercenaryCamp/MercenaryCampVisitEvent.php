<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp;

use AardsGerds\Game\Entity\Human\Mefadriel;
use AardsGerds\Game\Event\DecisionCollection;
use AardsGerds\Game\Event\Generic\DialogDecision;
use AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp\MeetMefadriel\MefadrielDialogEvent;
use AardsGerds\Game\Event\VisitEvent;

final class MercenaryCampVisitEvent extends VisitEvent
{
    public function __construct()
    {
        parent::__construct(
            new MercenaryCampVisitContext(),
            new DecisionCollection([
                new DialogDecision(new MefadrielDialogEvent(new Mefadriel())),
            ]),
        );
    }
}
