<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Integration\Player;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Talent\SecretKnowledge\Ascension;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerException;
use AardsGerds\Game\Tests\Integration\IntegrationTestCase;

final class PlayerTest extends IntegrationTestCase
{
    /**
     * @test
     * @dataProvider provideEtherumOverdoseCases
     */
    public function etherumOverdose(Player $player, Etherum $etherum): void
    {
        $expectedException = PlayerException::etherumOverdose();
        $this->expectException(get_class($expectedException));
        $this->expectExceptionMessage($expectedException->getMessage());

        $player->increaseEtherum($etherum);
    }

    public function provideEtherumOverdoseCases(): \Generator
    {
        yield 'noob' => [
            TestPlayerFactory::createNew(),
            new Etherum(1),
        ];

        yield 'etheurgist 5 ascension' => [
            TestPlayerFactory::createEtheurgist(Ascension::fifthAscension(), new Etherum(20)),
            new Etherum(100),
        ];
    }

    /**
     * @test
     * @dataProvider provideCorruptionCases
     */
    public function corruption(Player $player, Etherum $etherum): void
    {
        $player->increaseEtherum($etherum);

        self::assertTrue($player->isCorrupted());
    }

    public function provideCorruptionCases(): \Generator
    {
        yield 'etheurgist 6 ascension' => [
            TestPlayerFactory::createEtheurgist(Ascension::sixthAscension(), new Etherum(40)),
            new Etherum(150),
        ];

        yield 'etheurgist 8 ascension' => [
            TestPlayerFactory::createEtheurgist(Ascension::eighthAscension(), new Etherum(140)),
            new Etherum(300),
        ];
    }
}
