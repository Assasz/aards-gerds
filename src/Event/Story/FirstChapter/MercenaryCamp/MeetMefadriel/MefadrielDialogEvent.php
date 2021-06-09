<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp\MeetMefadriel;

use AardsGerds\Game\Dialog\DialogOption;
use AardsGerds\Game\Dialog\PlayerDialogOption;
use AardsGerds\Game\Dialog\PlayerDialogOptionCollection;
use AardsGerds\Game\Dialog\QuitDialogOption;
use AardsGerds\Game\Dialog\TradeDialogOption;
use AardsGerds\Game\Entity\Human\Mefadriel;
use AardsGerds\Game\Entity\Human\Tufus;
use AardsGerds\Game\Event\Decision\DecisionCollection;
use AardsGerds\Game\Event\Decision\VisitDecision;
use AardsGerds\Game\Event\DialogEvent;
use AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp\MercenaryCampVisitEvent;
use AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp\VisitBlacksmith\BlacksmithTradeEvent;

final class MefadrielDialogEvent extends DialogEvent
{
    public function __construct(Mefadriel $mefadriel)
    {
        parent::__construct(
            new MefadrielDialogContext(),
            new DecisionCollection([
                // todo: behold, infinite loop is coming
//                new VisitDecision(new MercenaryCampVisitEvent()),
            ]),
            $mefadriel,
            new DialogOption(
                'Hey, you. You are finally awake.',
                new PlayerDialogOptionCollection([
                    new PlayerDialogOption(
                        'Who are you?',
                        new DialogOption(
                            'My name is Mefadriel. I joined this miserable camp when they marched at south.',
                            new PlayerDialogOptionCollection([]),
                        ),
                    ),
                    new TradeDialogOption(
                        'Let us trade!',
                        new DialogOption('Alright.', new PlayerDialogOptionCollection([])),
                        new BlacksmithTradeEvent(new Tufus()), // todo
                    ),
                    new QuitDialogOption(
                        'Farewell.',
                        new DialogOption(
                            'See you soon.',
                            new PlayerDialogOptionCollection([]),
                        ),
                    ),
                ]),
            ),
        );
    }
}
