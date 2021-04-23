<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Unit\Fight;

use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\Effect\BlockImmunity;
use AardsGerds\Game\Build\Talent\Effect\EffectCollection;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Fight\Attack;
use AardsGerds\Game\Fight\EtherumAttack;
use AardsGerds\Game\Fight\MeleeAttack;
use AardsGerds\Game\Fight\Block;
use AardsGerds\Game\Fight\Fighter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class BlockTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideCases
     */
    public function calculatesChance(
        Fighter $attacker,
        Fighter $target,
        Attack $attack,
        float $expectedChance,
    ): void {
        self::assertSame($expectedChance, Block::calculateChance($attacker, $target, $attack));
    }

    /** @test */
    public function noChanceIfAttackHasBlockImmunity(): void
    {
        $attack = $this->createMock(MeleeAttack::class);
        $attack->method('getEffects')->willReturn(new EffectCollection([new BlockImmunity()]));

        self::assertSame(
            0.0,
            Block::calculateChance(
                $this->mockFighter(WeaponMasteryLevel::warrior(), new Strength(50)),
                $this->mockFighter(WeaponMasteryLevel::warrior(), new Strength(50)),
                $attack,
            ),
        );
    }

    /** @test */
    public function noChanceIfEtherumAttack(): void
    {
        self::assertSame(
            0.0,
            Block::calculateChance(
                $this->mockFighter(WeaponMasteryLevel::warrior(), new Strength(50)),
                $this->mockFighter(WeaponMasteryLevel::warrior(), new Strength(50)),
                $this->createMock(EtherumAttack::class),
            ),
        );
    }

    public function provideCases(): \Generator
    {
        yield 'attacker 2 wm level and 50 strength, target 4 wm level and 80 strength' => [
            $this->mockFighter(WeaponMasteryLevel::warrior(), new Strength(50)),
            $this->mockFighter(WeaponMasteryLevel::masterOfFirstTier(), new Strength(80)),
            $this->createMock(MeleeAttack::class),
            0.55,
        ];

        yield 'attacker 4 wm level and 80 strength, target 2 wm level and 50 strength' => [
            $this->mockFighter(WeaponMasteryLevel::masterOfFirstTier(), new Strength(80)),
            $this->mockFighter(WeaponMasteryLevel::warrior(), new Strength(50)),
            $this->createMock(MeleeAttack::class),
            0.2,
        ];

        yield 'attacker 2 wm level and 50 strength, target 6 wm level and 150 strength' => [
            $this->mockFighter(WeaponMasteryLevel::warrior(), new Strength(50)),
            $this->mockFighter(WeaponMasteryLevel::masterOfThirdTier(), new Strength(150)),
            $this->createMock(MeleeAttack::class),
            0.9,
        ];
    }

    private function mockFighter(WeaponMasteryLevel $weaponMasteryLevel, Strength $strength): MockObject
    {
        $fighter = $this->createMock(Fighter::class);
        $fighter->method('getWeaponMasteryLevel')->willReturn($weaponMasteryLevel);
        $fighter->method('getStrength')->willReturn($strength);

        return $fighter;
    }
}
