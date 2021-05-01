<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp\MeetMefadriel;

use AardsGerds\Game\Dialog\DialogOption;
use AardsGerds\Game\Dialog\DialogOptionCollection;
use AardsGerds\Game\Entity\Human\Mefadriel;
use AardsGerds\Game\Event\Decision\DecisionCollection;
use AardsGerds\Game\Event\DialogEvent;

final class MefadrielDialogEvent extends DialogEvent
{
    public function __construct(Mefadriel $mefadriel)
    {
        parent::__construct(
            new MefadrielDialogContext(),
            new DecisionCollection([]),
            $mefadriel,
            new DialogOption(
                'Hey, you. You are finally awake.',
                new DialogOptionCollection([
                    new DialogOption(
                        'Who are you?',
                        new DialogOptionCollection([
                            new DialogOption('My name is Mefadriel. I command this miserable camp.'),
                        ]),
                    ),
                    new DialogOption(
                        'I need your sword.',
                        new DialogOptionCollection([
                            new DialogOption('Then take it.'),
                        ]),
                    ),
                ]),
            ),
        );
    }
}
