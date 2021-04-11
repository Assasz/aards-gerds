<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Weapon;

final class WeaponType implements \Stringable
{
    public const SHORT_SWORD = 'Short Sword';
    public const GREAT_SWORD = 'Great Sword';
    public const BOW = 'Bow';

    private function __construct(
        private string $type,
    ) {}

    public static function shortSword(): self
    {
        return new self(self::SHORT_SWORD);
    }

    public static function greatSword(): self
    {
        return new self(self::GREAT_SWORD);
    }

    public static function bow(): self
    {
        return new self(self::BOW);
    }

    public function equals(self $type): bool
    {
        return $this->type === (string) $type;
    }

    public function __toString(): string
    {
        return $this->type;
    }
}
