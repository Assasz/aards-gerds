<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\WeaponMastery;

use AardsGerds\Game\Shared\IntegerValue;
use AardsGerds\Game\Shared\IntegerValueException;

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

    public function __toString(): string
    {
        return match ($this->value) {
            self::INEXPERIENCED => 'inexperienced',
            self::NOVICE => 'novice',
            self::WARRIOR => 'warrior',
            self::VETERAN => 'veteran',
            self::MASTER_OF_FIRST_TIER => 'master of first tier',
            self::MASTER_OF_SECOND_TIER => 'master of second tier',
            self::MASTER_OF_THIRD_TIER => 'master of third tier',
            default => throw IntegerValueException::invalidValue($this->value),
        };
    }

    protected function validate(): void
    {
        if (!in_array($this->value, range(self::INEXPERIENCED, self::MASTER_OF_THIRD_TIER))) {
            throw IntegerValueException::invalidValue($this->value);
        }
    }
}
