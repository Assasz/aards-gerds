<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Decision;

use AardsGerds\Game\Event\Event;

interface Decision extends \Stringable
{
    public function __invoke(): Event;
}
