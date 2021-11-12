<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Integration\Fight;

use AardsGerds\Game\Build\Talent\WeaponMastery\ShortSword\Novice\Slash;
use AardsGerds\Game\Entity\Beast\Animal\Wolf;
use AardsGerds\Game\Entity\Nameless\Nameless;
use AardsGerds\Game\Fight\Fight;
use AardsGerds\Game\Fight\Fighter;
use AardsGerds\Game\Fight\FighterCollection;
use AardsGerds\Game\Inventory\Alchemy\Potion\HealthPotion;
use AardsGerds\Game\Inventory\Weapon\ShortSword\ImperialSoldierSword;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;
use AardsGerds\Game\Player\PlayerException;
use AardsGerds\Game\Shared\IntegerValue;
use AardsGerds\Game\Tests\Integration\IntegrationTestCase;
use AardsGerds\Game\Tests\Integration\Player\TestPlayerFactory;
use AardsGerds\Game\Tests\Integration\Util\KillingStrike;

final class FightTest extends IntegrationTestCase
{
    /** @test */
    public function player1LvlVsWolf(): void
    {
        $player = TestPlayerFactory::createNew();
        $opponent = new Wolf();

        $playerAction = $this->createMock(PlayerAction::class);
        $playerAction->method('askForChoice')->willReturn(new Slash());

        try {
            Fight::invoke($player, new FighterCollection([$opponent]), $playerAction);
        } catch (PlayerException) {}

        $notDead = static fn(Fighter $fighter): bool => $fighter->getHealth()->isGreaterThan(new IntegerValue(0));

        echo ($notDead($player) ? 'Player won' : 'Wolf won') . PHP_EOL;

        self::assertTrue($notDead($player) || $notDead($opponent));
    }

    /**
     * @test
     * @dataProvider providePlayers
     */
    public function playerVsNameless(Player $player): void
    {
        $opponent = new Nameless();

        $playerAction = $this->createMock(PlayerAction::class);
        $playerAction->method('askForChoice')->willReturn(new Slash());

        try {
            Fight::invoke($player, new FighterCollection([$opponent]), $playerAction);
        } catch (PlayerException) {}

        $notDead = static fn(Fighter $fighter): bool => $fighter->getHealth()->isGreaterThan(new IntegerValue(0));

        echo ($notDead($player) ? 'Player won' : 'Nameless won') . PHP_EOL;

        self::assertTrue($notDead($player) || $notDead($opponent));
    }

    public function providePlayers(): \Generator
    {
        yield 'warrior with rusty sword' => [TestPlayerFactory::createWarrior()];

        yield 'veteran with imperial soldier sword' => [TestPlayerFactory::createVeteran(new ImperialSoldierSword())];
    }

    /** @test */
    public function playerVsMultipleOpponents(): void
    {
        $player = TestPlayerFactory::createNew();
        $firstOpponent = new Wolf();
        $secondOpponent = new Wolf();

        $playerAction = $this->createMock(PlayerAction::class);
        $playerAction->method('askForChoice')->willReturnOnConsecutiveCalls(
            new KillingStrike(),
            $firstOpponent,
            new KillingStrike(),
            $secondOpponent,
        );

        try {
            Fight::invoke($player, new FighterCollection([$firstOpponent, $secondOpponent]), $playerAction);
        } catch (PlayerException) {}

        $notDead = static fn(Fighter $fighter): bool => $fighter->getHealth()->isGreaterThan(new IntegerValue(0));

        self::assertTrue($notDead($player) || $notDead($firstOpponent) || $notDead($secondOpponent));
    }

    /** @test */
    public function playerHealsDuringFight(): void
    {
        $player = TestPlayerFactory::createNew();
        $playerPotions = $player->getInventory()->filterConsumable()->getItems();
        $opponent = new Wolf();

        $playerAction = $this->createMock(PlayerAction::class);
        $playerAction->method('askForChoice')->willReturnOnConsecutiveCalls(
            'Go to inventory',
            $playerPotions[0],
            'Go to inventory',
            $playerPotions[1],
            new KillingStrike(),
        );

        try {
            Fight::invoke($player, new FighterCollection([$opponent]), $playerAction);
        } catch (PlayerException) {}

        self::assertTrue($player->getInventory()->filterConsumable()->isEmpty());
    }
}
