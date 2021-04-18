<?php

declare(strict_types=1);

namespace AardsGerds\Game\Infrastructure\Persistence;

use AardsGerds\Game\Player\Player;

final class PlayerState
{
    public function __construct(
        private NormalizePlayer $normalizePlayer,
        private DenormalizePlayer $denormalizePlayer,
        private string $savesLocation,
    ) {}

    public function save(Player $player): void
    {
        $playerNormalized = ($this->normalizePlayer)($player);

        file_put_contents($this->resolvePlayerSaveFile($player->getName()), json_encode($playerNormalized));
    }

    /**
     * @throws PlayerStateException
     */
    public function load(string $playerName): Player
    {
        if (!file_exists($fileName = $this->resolvePlayerSaveFile($playerName))) {
            throw PlayerStateException::notFound($fileName);
        }

        assert(is_readable($fileName));
        $playerNormalized = json_decode(file_get_contents($fileName) ?: '', true);

        return ($this->denormalizePlayer)($playerNormalized);
    }

    private function resolvePlayerSaveFile(string $playerName): string
    {
        $playerSaveFile = str_replace(' ', '_', strtolower($playerName));

        return "{$this->savesLocation}/{$playerSaveFile}.json";
    }
}
