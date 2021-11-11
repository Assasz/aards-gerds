<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Integration\Player;

use AardsGerds\Game\Build\Attribute\AttributePoints;
use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Initiative;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Experience;
use AardsGerds\Game\Build\Level;
use AardsGerds\Game\Build\LevelProgress;
use AardsGerds\Game\Build\Talent\SecretKnowledge\Ascension;
use AardsGerds\Game\Build\Talent\SecretKnowledge\SecretKnowledge;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Build\Talent\TalentPoints;
use AardsGerds\Game\Build\Talent\WeaponMastery\ShortSword\Novice\Slash;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp\MercenaryCampVisitEvent;
use AardsGerds\Game\Inventory\Alchemy\Potion\HealthPotion;
use AardsGerds\Game\Inventory\Inventory;
use AardsGerds\Game\Inventory\Weapon\GreatSword\Amuril;
use AardsGerds\Game\Inventory\Weapon\ShortSword\RustyShortSword;
use AardsGerds\Game\Inventory\Weapon\Weapon;
use AardsGerds\Game\Player\Player;

final class TestPlayerFactory
{
    public static function createNew(string $name = 'Celestial'): Player
    {
        return Player::new($name);
    }

    public static function createWarrior(?Weapon $weapon = null): Player
    {
        return new Player(
            'Celestial',
            new Health(300),
            new Etherum(1),
            new Strength(60),
            new Initiative(20),
            new TalentCollection([
                WeaponMastery::shortSword(WeaponMasteryLevel::warrior()),
                new Slash(),
            ]),
            new Inventory([new HealthPotion(), new HealthPotion()]),
            $weapon ?? new RustyShortSword(),
            false,
            new LevelProgress(
                new Level(1),
                new Experience(1000),
            ),
            new Health(500),
            new AttributePoints(0),
            new TalentPoints(0),
            new MercenaryCampVisitEvent(),
        );
    }

    public static function createVeteran(?Weapon $weapon = null): Player
    {
        return new Player(
            'Celestial',
            new Health(500),
            new Etherum(1),
            new Strength(120),
            new Initiative(20),
            new TalentCollection([
                WeaponMastery::shortSword(WeaponMasteryLevel::veteran()),
                new Slash(),
            ]),
            new Inventory([new HealthPotion(), new HealthPotion()]),
            $weapon ?? new RustyShortSword(),
            false,
            new LevelProgress(
                new Level(1),
                new Experience(1000),
            ),
            new Health(500),
            new AttributePoints(0),
            new TalentPoints(0),
            new MercenaryCampVisitEvent(),
        );
    }

    public static function createEtheurgist(Ascension $ascension, Etherum $etherum): Player
    {
        return new Player(
            'Celestial',
            new Health(200),
            $etherum,
            new Strength(60),
            new Initiative(50),
            new TalentCollection([
                WeaponMastery::shortSword(WeaponMasteryLevel::warrior()),
                new SecretKnowledge($ascension),
                new Slash(),
            ]),
            new Inventory([new HealthPotion(), new HealthPotion()]),
            new Amuril(new Etherum(1)),
            false,
            new LevelProgress(
                new Level(100),
                new Experience(1000000),
            ),
            new Health(5000),
            new AttributePoints(0),
            new TalentPoints(0),
            new MercenaryCampVisitEvent(),
        );
    }
}
