<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\SecretKnowledge;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Shared\IntegerValue;
use AardsGerds\Game\Shared\IntegerValueException;

final class Ascension extends IntegerValue
{
    public const FIRST_ASCENSION = 1;
    public const SECOND_ASCENSION = 2;
    public const THIRD_ASCENSION = 3;
    public const FOURTH_ASCENSION = 4;
    public const FIFTH_ASCENSION = 5;
    public const SIXTH_ASCENSION = 6;
    public const SEVENTH_ASCENSION = 7;
    public const EIGHTH_ASCENSION = 8;

    public static function firstAscension(): self
    {
        return new self(self::FIRST_ASCENSION);
    }

    public static function secondAscension(): self
    {
        return new self(self::SECOND_ASCENSION);
    }

    public static function thirdAscension(): self
    {
        return new self(self::THIRD_ASCENSION);
    }

    public static function fourthAscension(): self
    {
        return new self(self::FOURTH_ASCENSION);
    }

    public static function fifthAscension(): self
    {
        return new self(self::FIFTH_ASCENSION);
    }

    public static function sixthAscension(): self
    {
        return new self(self::SIXTH_ASCENSION);
    }

    public static function seventhAscension(): self
    {
        return new self(self::SEVENTH_ASCENSION);
    }

    public static function eighthAscension(): self
    {
        return new self(self::EIGHTH_ASCENSION);
    }

    public function getRequiredEtherum(): Etherum
    {
        return match ($this->value) {
            self::FIRST_ASCENSION => new Etherum(1),
            self::SECOND_ASCENSION => new Etherum(2),
            self::THIRD_ASCENSION => new Etherum(4),
            self::FOURTH_ASCENSION => new Etherum(8),
            self::FIFTH_ASCENSION => new Etherum(16),
            self::SIXTH_ASCENSION => new Etherum(32),
            self::SEVENTH_ASCENSION => new Etherum(64),
            self::EIGHTH_ASCENSION => new Etherum(128),
            default => throw IntegerValueException::invalidValue($this->value),
        };
    }

    public function __toString(): string
    {
        return match ($this->value) {
            self::FIRST_ASCENSION => 'First Ascension',
            self::SECOND_ASCENSION => 'Second Ascension',
            self::THIRD_ASCENSION => 'Third Ascension',
            self::FOURTH_ASCENSION => 'Fourth Ascension',
            self::FIFTH_ASCENSION => 'Fifth Ascension',
            self::SIXTH_ASCENSION => 'Sixth Ascension',
            self::SEVENTH_ASCENSION => 'Seventh Ascension',
            self::EIGHTH_ASCENSION => 'Eighth Ascension',
            default => throw IntegerValueException::invalidValue($this->value),
        };
    }

    protected function validate(): void
    {
        if (!in_array($this->value, range(self::FIRST_ASCENSION, self::EIGHTH_ASCENSION))) {
            throw IntegerValueException::invalidValue($this->value);
        }
    }
}
