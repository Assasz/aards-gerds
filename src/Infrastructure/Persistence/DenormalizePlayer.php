<?php

declare(strict_types=1);

namespace AardsGerds\Game\Infrastructure\Persistence;

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
use AardsGerds\Game\Build\Talent\Talent;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Build\Talent\TalentPoints;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Inventory\Inventory;
use AardsGerds\Game\Inventory\InventoryItem;
use AardsGerds\Game\Inventory\Weapon\RebredirWeapon;
use AardsGerds\Game\Inventory\Weapon\Weapon;
use AardsGerds\Game\Inventory\Weapon\WeaponType;
use AardsGerds\Game\Player\Player;
use function Lambdish\Phunctional\map;

final class DenormalizePlayer
{
    public function __invoke(array $data): Player
    {
        return new Player(
            $data['name'],
            new Health($data['health']),
            new Etherum($data['etherum']),
            new Strength($data['strength']),
            new Initiative($data['initiative']),
            self::denormalizeTalents($data['talents']),
            self::denormalizeInventory($data['inventory']),
            $data['weapon'] !== null ? self::denormalizeWeapon($data['weapon']) : null,
            $data['corrupted'],
            new LevelProgress(
                new Level($data['levelProgress']['level']),
                new Experience($data['levelProgress']['currentExperience']),
            ),
            new Health($data['maximumHealth']),
            new AttributePoints($data['attributePoints']),
            new TalentPoints($data['talentPoints']),
        );
    }

    private static function denormalizeTalents(array $data): TalentCollection
    {
        return new TalentCollection(map(
            static function(array $talent): Talent {
                $reflection = new \ReflectionClass($talent['className']);

                $talent = match ($talent['className']) {
                    WeaponMastery::class =>
                        $reflection->newInstance(
                            new WeaponType($talent['type']),
                            new WeaponMasteryLevel($talent['level']),
                        ),
                    SecretKnowledge::class =>
                        $reflection->newInstance(new Ascension($talent['ascension'])),
                    default => $reflection->newInstance(),
                };

                assert($talent instanceof Talent);

                return $talent;
            },
            $data,
        ));
    }

    private static function denormalizeWeapon(array $data): Weapon
    {
        $reflection = new \ReflectionClass($data['className']);

        $weapon = match (true) {
            $reflection->isSubclassOf(RebredirWeapon::class) =>
                $reflection->newInstance(new Etherum($data['etherumLoad'])),
            default => $reflection->newInstance(),
        };

        assert($weapon instanceof Weapon);

        return $weapon;
    }

    private static function denormalizeInventory(array $data): Inventory
    {
        return new Inventory(map(
            static function(array $item): InventoryItem {
                $reflection = new \ReflectionClass($item['className']);

                $item = match (true) {
                    $reflection->isSubclassOf(Weapon::class) => self::denormalizeWeapon($item),
                    default => $reflection->newInstance(),
                };

                assert($item instanceof InventoryItem);

                return $item;
            },
            $data,
        ));
    }
}
