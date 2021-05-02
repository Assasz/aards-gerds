<?php

declare(strict_types=1);

namespace AardsGerds\Game\Dialog;

use AardsGerds\Game\Event\FightEvent;

final class FightDialogOption extends PlayerDialogOption
{
    public function __construct(
        string $dialog,
        DialogOption $response,
        private FightEvent $event,
    ) {
        parent::__construct($dialog, $response);
    }

    public function getEvent(): FightEvent
    {
        return $this->event;
    }
}
