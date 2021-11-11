<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Unit\Shared;

use AardsGerds\Game\Shared\Dice;
use AardsGerds\Game\Shared\IntegerValue;
use PHPUnit\Framework\TestCase;

final class DiceTest extends TestCase
{
    /** @test */
    public function mustRollTrue(): void
    {
        self::assertTrue(Dice::roll(new IntegerValue(1000))); // 100% chance
    }

    /** @test */
    public function mustRollFalse(): void
    {
        self::assertFalse(Dice::roll(new IntegerValue(0))); // 0% chance
    }
}
