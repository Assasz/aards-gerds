<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Unit\Build\Talent\WeaponMastery;

use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use PHPUnit\Framework\TestCase;

final class WeaponMasteryLevelTest extends TestCase
{
    /** @test */
    public function inexperienced(): void
    {
        $weaponMasteryLevel = WeaponMasteryLevel::inexperienced();

        self::assertSame(0, $weaponMasteryLevel->get());
        self::assertSame('inexperienced', (string) $weaponMasteryLevel);
    }

    /** @test */
    public function novice(): void
    {
        $weaponMasteryLevel = WeaponMasteryLevel::novice();

        self::assertSame(1, $weaponMasteryLevel->get());
        self::assertSame('novice', (string) $weaponMasteryLevel);
    }

    /** @test */
    public function warrior(): void
    {
        $weaponMasteryLevel = WeaponMasteryLevel::warrior();

        self::assertSame(2, $weaponMasteryLevel->get());
        self::assertSame('warrior', (string) $weaponMasteryLevel);
    }

    /** @test */
    public function veteran(): void
    {
        $weaponMasteryLevel = WeaponMasteryLevel::veteran();

        self::assertSame(3, $weaponMasteryLevel->get());
        self::assertSame('veteran', (string) $weaponMasteryLevel);
    }

    /** @test */
    public function masterOfFirstTier(): void
    {
        $weaponMasteryLevel = WeaponMasteryLevel::masterOfFirstTier();

        self::assertSame(4, $weaponMasteryLevel->get());
        self::assertSame('master of first tier', (string) $weaponMasteryLevel);
    }

    /** @test */
    public function masterOfSecondTier(): void
    {
        $weaponMasteryLevel = WeaponMasteryLevel::masterOfSecondTier();

        self::assertSame(5, $weaponMasteryLevel->get());
        self::assertSame('master of second tier', (string) $weaponMasteryLevel);
    }

    /** @test */
    public function masterOfThirdTier(): void
    {
        $weaponMasteryLevel = WeaponMasteryLevel::masterOfThirdTier();

        self::assertSame(6, $weaponMasteryLevel->get());
        self::assertSame('master of third tier', (string) $weaponMasteryLevel);
    }
}
