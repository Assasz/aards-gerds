<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp\VisitBlacksmith;

use AardsGerds\Game\Entity\Human\Tufus;
use AardsGerds\Game\Event\Decision\DecisionCollection;
use AardsGerds\Game\Event\TradeEvent;

final class BlacksmithTradeEvent extends TradeEvent
{
    public function __construct(Tufus $tufus)
    {
        parent::__construct(
            new BlacksmithTradeContext(),
            new DecisionCollection([]),
            $tufus,
        );
    }
}
