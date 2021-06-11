<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp\VisitBlacksmith;

use AardsGerds\Game\Dialog\DialogOption;
use AardsGerds\Game\Dialog\PlayerDialogOptionCollection;
use AardsGerds\Game\Dialog\QuitDialogOption;
use AardsGerds\Game\Dialog\TradeDialogOption;
use AardsGerds\Game\Entity\Human\Tufus;
use AardsGerds\Game\Event\Decision\DecisionCollection;
use AardsGerds\Game\Event\DialogEvent;

final class BlacksmithDialogEvent extends DialogEvent
{
    public function __construct(Tufus $tufus)
    {
        parent::__construct(
            new BlacksmithDialogContext(),
            new DecisionCollection([]),
            $tufus,
            new DialogOption(
                'Hello stranger. Do you need something?',
                new PlayerDialogOptionCollection([
                    new TradeDialogOption(
                        'Let us trade!',
                        new DialogOption('Alright.', new PlayerDialogOptionCollection([])),
                        new BlacksmithTradeEvent($tufus),
                    ),
                    new QuitDialogOption(
                        'Farewell.',
                        new DialogOption(
                            'Come back later.',
                            new PlayerDialogOptionCollection([]),
                        ),
                    ),
                ])
            ),
        );
    }
}
