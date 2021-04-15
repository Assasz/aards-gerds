<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

final class EventType implements \Stringable
{
    public const FIGHT = 'fight';
    public const DIALOG = 'dialog';
    public const TRADE = 'trade';
    public const TRAVEL = 'travel';
    public const ENCOUNTER = 'encounter';
    public const LOOT = 'loot';
    public const EXPLORE = 'explore';
    public const RETREAT = 'retreat';

    private function __construct(
        private string $value,
    ) {}

    public static function fight(): self
    {
        return new self(self::FIGHT);
    }

    public static function dialog(): self
    {
        return new self(self::DIALOG);
    }

    public static function trade(): self
    {
        return new self(self::TRADE);
    }

    public static function travel(): self
    {
        return new self(self::TRAVEL);
    }

    public static function encounter(): self
    {
        return new self(self::ENCOUNTER);
    }

    public static function loot(): self
    {
        return new self(self::LOOT);
    }

    public static function explore(): self
    {
        return new self(self::EXPLORE);
    }

    public static function retreat(): self
    {
        return new self(self::RETREAT);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
