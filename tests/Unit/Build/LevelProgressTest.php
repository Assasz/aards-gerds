<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Unit\Build;

use AardsGerds\Game\Build\Experience;
use AardsGerds\Game\Build\Level;
use AardsGerds\Game\Build\LevelProgress;
use AardsGerds\Game\Player\Player;
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
        );

        self::assertSame(3, $levelProgress->getLevel()->get());
        self::assertSame(2100, $levelProgress->getCurrentExperience()->get());
    }

    /** @test */
    public function increasesTo11Level(): void
    {
        $levelProgress = new LevelProgress(new Level(10), new Experience(9000));
        $levelProgress->increase(
            new Experience(2000),
            $this->createMock(Player::class),
        );

        self::assertSame(11, $levelProgress->getLevel()->get());
        self::assertSame(11000, $levelProgress->getCurrentExperience()->get());
    }

    /** @test */
    public function increasesTo21Level(): void
    {
        $levelProgress = new LevelProgress(new Level(20), new Experience(29000));
        $levelProgress->increase(
            new Experience(3000),
            $this->createMock(Player::class),
        );

        self::assertSame(21, $levelProgress->getLevel()->get());
        self::assertSame(32000, $levelProgress->getCurrentExperience()->get());
    }
}
