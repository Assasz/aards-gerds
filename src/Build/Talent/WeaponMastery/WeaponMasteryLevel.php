<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\WeaponMastery;

use AardsGerds\Game\Shared\IntegerValue;

final class WeaponMasteryLevel extends IntegerValue
{
    public const INEXPERIENCED = 0;
    public const NOVICE = 1;
    public const WARRIOR = 2;
    public const VETERAN = 3;
    public const MASTER_OF_FIRST_TIER = 4;
    public const MASTER_OF_SECOND_TIER = 5;
    public const MASTER_OF_THIRD_TIER = 6;

    public static function inexperienced(): self
    {
        return new self(self::INEXPERIENCED);
    }

    public static function novice(): self
    {
        return new self(self::NOVICE);
    }

    public static function warrior(): self
    {
        return new self(self::WARRIOR);
    }

    public static function veteran(): self
    {
        return new self(self::VETERAN);
    }

    public static function masterOfFirstTier(): self
    {
        return new self(self::MASTER_OF_FIRST_TIER);
    }

    public static function masterOfSecondTier(): self
    {
        return new self(self::MASTER_OF_SECOND_TIER);
    }

    public static function masterOfThirdTier(): self
    {
        return new self(self::MASTER_OF_THIRD_TIER);
    }
}
