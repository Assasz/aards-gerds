<?php

declare(strict_types=1);

namespace AardsGerds\Game\Dialog;

class PlayerDialogOption extends DialogOption
{
    public function __construct(
        string $dialog,
        private NpcDialogOption $response,
    ) {
        parent::__construct($dialog);
    }

    public function getResponse(): NpcDialogOption
    {
        return $this->response;
    }
}
