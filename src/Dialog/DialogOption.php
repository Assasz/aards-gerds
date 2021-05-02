<?php

declare(strict_types=1);

namespace AardsGerds\Game\Dialog;

final class DialogOption implements \Stringable
{
    public function __construct(
        private string $dialog,
        private PlayerDialogOptionCollection $responses,
    ) {}

    public function getResponses(): PlayerDialogOptionCollection
    {
        return $this->responses;
    }

    public function __toString(): string
    {
        return $this->dialog;
    }
}
