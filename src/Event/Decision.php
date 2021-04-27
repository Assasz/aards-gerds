<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

interface Decision extends \Stringable
{
    public function __invoke(): Event;
}
