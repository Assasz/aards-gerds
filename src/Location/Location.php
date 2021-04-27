<?php

declare(strict_types=1);

namespace AardsGerds\Game\Location;

abstract class Location implements \Stringable
{
    public function __construct(
        protected string $name,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
