<?php

declare(strict_types=1);

namespace AardsGerds\Game\Dialog;

use AardsGerds\Game\Event\Event;

final class DialogOption implements \Stringable
{
    public function __construct(
        private string $dialog,
        private ?DialogOptionCollection $responses = null,
        private ?Event $consequence = null,
    ) {}

    public function getResponses(): ?DialogOptionCollection
    {
        return $this->responses;
    }

    public function getConsequence(): ?Event
    {
        return $this->consequence;
    }

    public function __toString(): string
    {
        return $this->dialog;
    }
}
