<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp\MeetMefadriel;

use AardsGerds\Game\Dialog\NpcDialogOption;
use AardsGerds\Game\Dialog\PlayerDialogOption;
use AardsGerds\Game\Dialog\PlayerDialogOptionCollection;
use AardsGerds\Game\Dialog\QuitDialogOption;
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
            new NpcDialogOption(
                'Hey, you. You are finally awake.',
                new PlayerDialogOptionCollection([
                    new PlayerDialogOption(
                        'Who are you?',
                        new NpcDialogOption(
                            'My name is Mefadriel. I joined this miserable camp when they marched at south.',
                            new PlayerDialogOptionCollection([]),
                        ),
                    ),
                    new QuitDialogOption(
                        'Farewell.',
                        new NpcDialogOption(
                            'See you soon.',
                            new PlayerDialogOptionCollection([]),
                        ),
                    ),
                ]),
            ),
        );
    }
}
