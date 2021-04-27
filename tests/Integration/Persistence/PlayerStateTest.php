<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Integration\Persistence;

use AardsGerds\Game\Build\Attribute\AttributePoints;
use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Initiative;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Experience;
use AardsGerds\Game\Build\Level;
use AardsGerds\Game\Build\LevelProgress;
use AardsGerds\Game\Build\Talent\SecretKnowledge\Ascension;
use AardsGerds\Game\Build\Talent\SecretKnowledge\FirstAscension\Haze;
use AardsGerds\Game\Build\Talent\SecretKnowledge\SecretKnowledge;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Build\Talent\TalentPoints;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp\MercenaryCampVisitEvent;
use AardsGerds\Game\Infrastructure\Persistence\PlayerState;
use AardsGerds\Game\Infrastructure\Persistence\PlayerStateException;
use AardsGerds\Game\Inventory\Inventory;
use AardsGerds\Game\Inventory\Trophy\WolfFur;
use AardsGerds\Game\Inventory\Weapon\GreatSword\Amuril;
use AardsGerds\Game\Inventory\Weapon\ShortSword\RustyShortSword;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Tests\Integration\IntegrationTestCase;

final class PlayerStateTest extends IntegrationTestCase
{
    private string $savesLocation;
    private PlayerState $playerState;

    public function setUp(): void
    {
        parent::setUp();
        $this->savesLocation = self::getParameter('savesLocation');
        $this->playerState = self::getService(PlayerState::class);
    }

    /** @test */
    public function savesPlayerStateIntoFile(): void
    {
        $player = new Player(
            'Celestial',
            new Health(100),
            new Etherum(50),
            new Strength(50),
            new Initiative(10),
            new TalentCollection([
                WeaponMastery::greatSword(WeaponMasteryLevel::masterOfFirstTier()),
                new SecretKnowledge(Ascension::sixthAscension()),
                new Haze(),
            ]),
            new Inventory([new WolfFur(), new RustyShortSword()]),
            new Amuril(new Etherum(100)),
            true,
            new LevelProgress(new Level(10), new Experience(9000)),
            new Health(100),
            new AttributePoints(5),
            new TalentPoints(5),
            new MercenaryCampVisitEvent(),
        );

        $this->playerState->save($player);

        self::assertJsonFileEqualsJsonFile(
            "{$this->savesLocation}/celestial_expected.json",
            "{$this->savesLocation}/celestial.json",
        );

        $player = $this->playerState->load('Celestial');

        self::assertSame('Celestial', $player->getName());
        self::assertSame('Amuril', $player->getWeapon()->getName());
    }

    /** @test */
    public function throwsExceptionOnNotExistentFile(): void
    {
        $this->expectException(PlayerStateException::class);

        $this->playerState->load('nonsense');
    }
}
