<?php

declare(strict_types=1);

namespace AardsGerds\Game\Dialog;

final class NpcDialogOption extends DialogOption
{
    public function __construct(
        string $dialog,
        private PlayerDialogOptionCollection $responses,
    ) {
        parent::__construct($dialog);
    }

    public function getResponses(): PlayerDialogOptionCollection
    {
        return $this->responses;
    }
}
