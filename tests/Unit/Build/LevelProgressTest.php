<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Unit\Build;

use AardsGerds\Game\Build\Experience;
use AardsGerds\Game\Build\Level;
use AardsGerds\Game\Build\LevelProgress;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;
use PHPUnit\Framework\TestCase;

final class LevelProgressTest extends TestCase
{
    /** @test */
    public function increasesWithLevelUp(): void
    {
        $levelProgress = new LevelProgress(new Level(1), new Experience(100));
        $levelProgress->increase(
            new Experience(1000),
            $this->createMock(Player::class),
            $this->createMock(PlayerAction::class),
        );

        self::assertSame(2, $levelProgress->getLevel()->get());
        self::assertSame(1100, $levelProgress->getCurrentExperience()->get());
    }

    /** @test */
    public function increasesWithMultipleLevelUps(): void
    {
        $levelProgress = new LevelProgress(new Level(1), new Experience(100));
        $levelProgress->increase(
            new Experience(2000),
            $this->createMock(Player::class),
            $this->createMock(PlayerAction::class),
        );

        self::assertSame(3, $levelProgress->getLevel()->get());
        self::assertSame(2100, $levelProgress->getCurrentExperience()->get());
    }

    /**
     * @test
     * @dataProvider provideCases
     */
    public function increases(
        LevelProgress $levelProgress,
        Experience $requiredExperience,
        Level $expectedLevel,
        Experience $expectedExperience,
    ): void {
        $levelProgress->increase(
            $requiredExperience,
            $this->createMock(Player::class),
            $this->createMock(PlayerAction::class),
        );

        self::assertTrue($levelProgress->getLevel()->equals($expectedLevel));
        self::assertTrue($levelProgress->getCurrentExperience()->equals($expectedExperience));
    }

    public function provideCases(): \Generator
    {
        yield 'from 10 to 11 level' => [
            new LevelProgress(new Level(10), new Experience(9000)),
            new Experience(2000),
            new Level(11),
            new Experience(11000),
        ];

        yield 'from 20 to 21 level' => [
            new LevelProgress(new Level(20), new Experience(29000)),
            new Experience(3000),
            new Level(21),
            new Experience(32000),
        ];
    }
}
