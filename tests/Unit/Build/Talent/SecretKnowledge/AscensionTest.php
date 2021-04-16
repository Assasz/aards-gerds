<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Unit\Build\Talent\SecretKnowledge;

use AardsGerds\Game\Build\Talent\SecretKnowledge\Ascension;
use AardsGerds\Game\Shared\IntegerValueException;
use PHPUnit\Framework\TestCase;

final class AscensionTest extends TestCase
{
    /** @test */
    public function firstAscension(): void
    {
        $ascension = Ascension::firstAscension();

        self::assertSame(1, $ascension->get());
        self::assertSame('First Ascension', (string) $ascension);
        self::assertSame(1, $ascension->getRequiredEtherum()->get());
    }

    /** @test */
    public function secondAscension(): void
    {
        $ascension = Ascension::secondAscension();

        self::assertSame(2, $ascension->get());
        self::assertSame('Second Ascension', (string) $ascension);
        self::assertSame(2, $ascension->getRequiredEtherum()->get());
    }

    /** @test */
    public function thirdAscension(): void
    {
        $ascension = Ascension::thirdAscension();

        self::assertSame(3, $ascension->get());
        self::assertSame('Third Ascension', (string) $ascension);
        self::assertSame(4, $ascension->getRequiredEtherum()->get());
    }

    /** @test */
    public function fourthAscension(): void
    {
        $ascension = Ascension::fourthAscension();

        self::assertSame(4, $ascension->get());
        self::assertSame('Fourth Ascension', (string) $ascension);
        self::assertSame(8, $ascension->getRequiredEtherum()->get());
    }

    /** @test */
    public function fifthAscension(): void
    {
        $ascension = Ascension::fifthAscension();

        self::assertSame(5, $ascension->get());
        self::assertSame('Fifth Ascension', (string) $ascension);
        self::assertSame(16, $ascension->getRequiredEtherum()->get());
    }

    /** @test */
    public function sixthAscension(): void
    {
        $ascension = Ascension::sixthAscension();

        self::assertSame(6, $ascension->get());
        self::assertSame('Sixth Ascension', (string) $ascension);
        self::assertSame(32, $ascension->getRequiredEtherum()->get());
    }

    /** @test */
    public function seventhAscension(): void
    {
        $ascension = Ascension::seventhAscension();

        self::assertSame(7, $ascension->get());
        self::assertSame('Seventh Ascension', (string) $ascension);
        self::assertSame(64, $ascension->getRequiredEtherum()->get());
    }

    /** @test */
    public function eightAscension(): void
    {
        $ascension = Ascension::eighthAscension();

        self::assertSame(8, $ascension->get());
        self::assertSame('Eighth Ascension', (string) $ascension);
        self::assertSame(128, $ascension->getRequiredEtherum()->get());
    }

    /** @test */
    public function throwsExceptionOnInvalidValue(): void
    {
        $this->expectException(IntegerValueException::class);

        new Ascension(10);
    }
}
