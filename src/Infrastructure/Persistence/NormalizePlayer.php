<?php

declare(strict_types=1);

namespace AardsGerds\Game\Infrastructure\Persistence;

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
            'talents' => 'not implemented yet',
            'inventory' => 'not implemented yet',
            'weapon' => 'not implemented yet',
            'corrupted' => $player->isCorrupted(),
            'levelProgress' => [
                'level' => $player->getLevelProgress()->getLevel()->get(),
                'currentExperience' => $player->getLevelProgress()->getCurrentExperience()->get(),
            ],
            'attributePoints' => $player->getAttributePoints()->get(),
            'talentPoints' => $player->getTalentPoints()->get(),
        ];
    }
}
