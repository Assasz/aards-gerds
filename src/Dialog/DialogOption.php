<?php

declare(strict_types=1);

namespace AardsGerds\Game\Dialog;

abstract class DialogOption implements \Stringable
{
    public function __construct(
        protected string $dialog,
    ) {}

    public function __toString(): string
    {
        return $this->dialog;
    }
}
