<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Unit\Shared;

use AardsGerds\Game\Shared\IntegerValue;
use PHPUnit\Framework\TestCase;

final class IntegerValueTest extends TestCase
{
    /** @test */
    public function isStringable(): void
    {
        self::assertIsString((string) new IntegerValue(1));
    }

    /**
     * @test
     * @dataProvider provideIntegerValuesWithExpectedAdvantage
     */
    public function calculatesAdvantage(
        IntegerValue $firstValue,
        IntegerValue $secondValue,
        int $expectedAdvantage,
    ): void {
        self::assertSame($expectedAdvantage, $firstValue->advantage($secondValue));
    }

    public function provideIntegerValuesWithExpectedAdvantage(): \Generator
    {
        yield 'first value greater' => [
            new IntegerValue(10),
            new IntegerValue(6),
            4,
        ];

        yield 'second value greater' => [
            new IntegerValue(6),
            new IntegerValue(10),
            0,
        ];
    }
}
