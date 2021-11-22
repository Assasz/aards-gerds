<?php

declare(strict_types=1);

namespace AardsGerds\Game\Infrastructure\Persistence;

use AardsGerds\Game\Build\Talent\SecretKnowledge\SecretKnowledge;
use AardsGerds\Game\Build\Talent\Talent;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Inventory\Inventory;
use AardsGerds\Game\Inventory\InventoryItem;
use AardsGerds\Game\Inventory\Weapon\RebredirWeapon;
use AardsGerds\Game\Inventory\Weapon\Weapon;
use AardsGerds\Game\Player\Player;
use function Lambdish\Phunctional\map;

final class NormalizePlayer
{
    public function __invoke(Player $player): array
    {
        return [
            'name' => $player->getName(),
            'health' => $player->getHealth()->get(),
            'etherum' => $player->getEtherum()->get(),
            'strength' => $player->getStrength()->get(),
            'initiative' => $player->getInitiative()->get(),
            'talents' => self::normalizeTalents($player->getTalents()),
            'inventory' => self::normalizeInventory($player->getInventory()),
            'weapon' => $player->getWeapon() !== null ? self::normalizeWeapon($player->getWeapon()) : null,
            'corruption' => $player->getCorruption()?->get(),
            'levelProgress' => [
                'level' => $player->getLevelProgress()->getLevel()->get(),
                'currentExperience' => $player->getLevelProgress()->getCurrentExperience()->get(),
            ],
            'maximumHealth' => $player->getMaximumHealth()->get(),
            'attributePoints' => $player->getAttributePoints()->get(),
            'talentPoints' => $player->getTalentPoints()->get(),
            'checkpoint' => ['className' => get_class($player->getCheckpoint())],
        ];
    }

    private static function normalizeTalents(TalentCollection $talentCollection): array
    {
        return map(
            static function(Talent $talent): array {
                $data = ['className' => get_class($talent)];

                return match (true) {
                    $talent instanceof SecretKnowledge => array_merge($data, [
                        'ascension' => $talent->getAscension()->get(),
                    ]),
                    $talent instanceof WeaponMastery => array_merge($data, [
                        'type' => (string) $talent->getType(),
                        'level' => $talent->getLevel()->get(),
                    ]),
                    default => $data,
                };
            },
            $talentCollection,
        );
    }

    private static function normalizeWeapon(Weapon $weapon): array
    {
        $data = ['className' => get_class($weapon)];

        return match (true) {
            $weapon instanceof RebredirWeapon => array_merge($data, [
                'etherumLoad' => $weapon->getEtherumLoad()->get(),
            ]),
            default => $data,
        };
    }

    private static function normalizeInventory(Inventory $inventory): array
    {
        return map(
            static function(InventoryItem $inventoryItem): array {
                return match (true) {
                    $inventoryItem instanceof Weapon => self::normalizeWeapon($inventoryItem),
                    default => ['className' => get_class($inventoryItem)],
                };
            },
            $inventory,
        );
    }
}
