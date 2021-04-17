<?php

declare(strict_types=1);

namespace AardsGerds\Game\Infrastructure\Persistence;

use AardsGerds\Game\Build\Talent\Talent;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Inventory\Inventory;
use AardsGerds\Game\Inventory\InventoryItem;
use AardsGerds\Game\Inventory\Weapon\RebredirWeapon;
use AardsGerds\Game\Inventory\Weapon\Weapon;
use AardsGerds\Game\Player\Player;

final class NormalizePlayer
{
    public function __invoke(Player $player): array
    {
        return [
            'name' => $player->getName(),
            'health' => $player->getHealth()->get(),
            'etherum' => $player->getEtherum()->get(),
            'strength' => $player->getStrength()->get(),
            'talents' => $this->normalizeTalents($player->getTalents()),
            'inventory' => $this->normalizeInventory($player->getInventory()),
            'weapon' => $player->getWeapon() !== null ? $this->normalizeWeapon($player->getWeapon()) : null,
            'corrupted' => $player->isCorrupted(),
            'levelProgress' => [
                'level' => $player->getLevelProgress()->getLevel()->get(),
                'currentExperience' => $player->getLevelProgress()->getCurrentExperience()->get(),
            ],
            'attributePoints' => $player->getAttributePoints()->get(),
            'talentPoints' => $player->getTalentPoints()->get(),
        ];
    }

    private function normalizeWeapon(Weapon $weapon): array
    {
        $data = ['className' => $className = get_class($weapon)];

        if (in_array(RebredirWeapon::class, class_uses($className) ?: [])) {
            /** @var RebredirWeapon $weapon */
            $data = array_merge($data, ['etherumLoad' => $weapon->getEtherumLoad()]); /** @phpstan-ignore-line */
        }

        return $data;
    }

    private function normalizeTalents(TalentCollection $talentCollection): array
    {
        return array_map(
            static fn(Talent $talent): array => [
                'className' => get_class($talent),
            ],
            $talentCollection->getItems(),
        );
    }

    private function normalizeInventory(Inventory $inventory): array
    {
        return array_map(
            static fn(InventoryItem $inventoryItem): array => [
                'className' => get_class($inventoryItem),
            ],
            $inventory->getItems(),
        );
    }
}
