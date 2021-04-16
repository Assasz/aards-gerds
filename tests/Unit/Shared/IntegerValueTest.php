<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Unit\Shared;

use AardsGerds\Game\Shared\IntegerValue;
use AardsGerds\Game\Shared\IntegerValueException;
use PHPUnit\Framework\TestCase;

final class IntegerValueTest extends TestCase
{
    /** @test */
    public function isStringable(): void
    {
        self::assertIsString((string) new IntegerValue(1));
    }

    /** @test */
    public function canBeEqual(): void
    {
        self::assertTrue((new IntegerValue(10))->equals(new IntegerValue(10)));
    }

    /** @test */
    public function canBeLowerThan(): void
    {
        self::assertTrue((new IntegerValue(5))->isLowerThan(new IntegerValue(10)));
    }

    /** @test */
    public function canBeGreaterThan(): void
    {
        self::assertTrue((new IntegerValue(10))->isGreaterThan(new IntegerValue(5)));
    }

    /** @test */
    public function calculatesDifference(): void {
        self::assertSame(
            (new IntegerValue(5))->get(),
            (new IntegerValue(10))->diff(new IntegerValue(5))->get(),
        );
    }

    /** @test */
    public function canBeIncremented(): void
    {
        self::assertSame(6, (new IntegerValue(5))->increment()->get());
    }

    /** @test */
    public function canBeIncreased(): void
    {
        self::assertSame(10, (new IntegerValue(5))->increaseBy(new IntegerValue(5))->get());
    }

    /** @test */
    public function throwsExceptionOnNegativeValue(): void
    {
        $this->expectException(IntegerValueException::class);

        new IntegerValue(-1);
    }
}
