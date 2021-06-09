<?php

declare(strict_types=1);

namespace AardsGerds\Game\Dialog;

use AardsGerds\Game\Event\TradeEvent;

final class TradeDialogOption extends PlayerDialogOption implements DialogOptionWithConsequence
{
    public function __construct(
        string $dialog,
        DialogOption $response,
        private TradeEvent $event,
    ) {
        parent::__construct($dialog, $response);
    }

    public function getEvent(): TradeEvent
    {
        return $this->event;
    }
}
