<?php

declare(strict_types=1);

namespace AardsGerds\Game\Dialog;

use AardsGerds\Game\Event\Event;

interface DialogOptionWithConsequence
{
    public function getEvent(): Event;
}
