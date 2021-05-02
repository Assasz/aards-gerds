<?php

declare(strict_types=1);

namespace AardsGerds\Game\Dialog;

class PlayerDialogOption implements \Stringable
{
    public function __construct(
        private string $dialog,
        private DialogOption $response,
    ) {}

    public function getResponse(): DialogOption
    {
        return $this->response;
    }

    public function __toString(): string
    {
        return $this->dialog;
    }
}
