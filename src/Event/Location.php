<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

final class Location implements \Stringable
{
    public const MERCENARY_CAMP = 'Mercenary Camp';
    public const DARK_WOODS = 'Dark Woods';

    private function __construct(
        private string $location,
    ) {}

    public static function mercenaryCamp(): self
    {
        return new self(self::MERCENARY_CAMP);
    }

    public static function darkWoods(): self
    {
        return new self(self::DARK_WOODS);
    }

    public function __toString(): string
    {
        return $this->location;
    }
}
