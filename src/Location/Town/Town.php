<?php

declare(strict_types=1);

namespace AardsGerds\Game\Location\Town;

use AardsGerds\Game\Location\Location;

abstract class Town extends Location
{
    public function __construct(
        string $name,
        protected VisitorCollection $visitors,
    ) {
        parent::__construct($name);
    }

    public function getVisitors(): VisitorCollection
    {
        return $this->visitors;
    }
}
