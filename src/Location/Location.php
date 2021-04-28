<?php

declare(strict_types=1);

namespace AardsGerds\Game\Location;

abstract class Location implements \Stringable
{
    public function __construct(
        protected string $name,
        protected VisitorCollection $visitors,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getVisitors(): VisitorCollection
    {
        return $this->visitors;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
