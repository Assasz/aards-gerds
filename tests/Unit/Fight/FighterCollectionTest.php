<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Unit\Fight;

use AardsGerds\Game\Build\Attribute\Initiative;
use AardsGerds\Game\Fight\Fighter;
use AardsGerds\Game\Fight\FighterCollection;
use PHPUnit\Framework\TestCase;

final class FighterCollectionTest extends TestCase
{
    /** @test */
    public function orderByInitiative(): void
    {
        $fighterOne = $this->createMock(Fighter::class);
        $fighterOne->method('getInitiative')->willReturn(new Initiative(20));
        $fighterTwo = $this->createMock(Fighter::class);
        $fighterTwo->method('getInitiative')->willReturn(new Initiative(10));
        $fighterThree = $this->createMock(Fighter::class);
        $fighterThree->method('getInitiative')->willReturn(new Initiative(30));

        $fighters = new FighterCollection([$fighterOne, $fighterTwo, $fighterThree]);
        $orderedFighters = $fighters->orderByInitiative();

        self::assertSame($fighterThree, $orderedFighters->getItems()[0]);
        self::assertSame($fighterOne, $orderedFighters->getItems()[1]);
        self::assertSame($fighterTwo, $orderedFighters->getItems()[2]);
    }
}
