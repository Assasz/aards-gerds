<?php

declare(strict_types=1);

namespace AardsGerds\Game\Dialog;

final class Consequence implements \Stringable
{
    private const FIGHT = 'fight';
    private const TRADE = 'trade';

    private function __construct(
        private string $type,
    ) {}

    public static function fight(): self
    {
        return new self(self::FIGHT);
    }

    public static function trade(): self
    {
        return new self(self::TRADE);
    }

    public function __toString(): string
    {
        return $this->type;
    }
}
