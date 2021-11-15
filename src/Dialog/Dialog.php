<?php

declare(strict_types=1);

namespace AardsGerds\Game\Dialog;

use AardsGerds\Game\Entity\Entity;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

final class Dialog
{
    public function __construct(
        private Player $player,
        private Entity $npc,
        private NpcDialogOption $dialogOption,
    ) {}

    public function __invoke(PlayerAction $playerAction): void
    {
        $playerAction->tell("{$this->npc->getName()}: {$this->dialogOption}");

        while (!$this->dialogOption->getResponses()->isEmpty()) {
            $this->playerDialog($playerAction, $this->dialogOption->getResponses());
        }
    }

    private function playerDialog(PlayerAction $playerAction, PlayerDialogOptionCollection $dialogOptions): void
    {
        $playerDialogChoice = $playerAction->askForDialogChoice($dialogOptions);

        $playerAction->tell("{$this->player->getName()}: {$playerDialogChoice}");
        $this->npcDialog($playerAction, $playerDialogChoice->getResponse());

        if ($playerDialogChoice instanceof QuitDialogOption) {
            $this->dialogOption->getResponses()->clear();
            return;
        }

        $this->dialogOption->getResponses()->remove($playerDialogChoice);

        if ($playerDialogChoice instanceof FightDialogOption) {
            $playerAction->askForConfirmation('Continue?');
            $playerDialogChoice->getEvent()($this->player, $playerAction);
        }
    }

    private function npcDialog(PlayerAction $playerAction, NpcDialogOption $dialogOption): void
    {
        $playerAction->tell("{$this->npc->getName()}: {$dialogOption}");

        if ($dialogOption->getResponses()->isEmpty()) {
            return;
        }

        $this->playerDialog($playerAction, $dialogOption->getResponses());
    }
}
