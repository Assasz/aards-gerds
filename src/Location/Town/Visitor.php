<?php

declare(strict_types=1);

namespace AardsGerds\Game\Location\Town;

interface Visitor extends \Stringable
{
    public function getName(): string;

    public function getRole(): VisitorRole;
}
