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
        private Entity $interlocutor,
        private DialogOption $dialogOption,
        private PlayerAction $playerAction,
    ) {}

    public function __invoke(): void
    {
        $this->playerAction->tell("{$this->interlocutor->getName()}: {$this->dialogOption}");

        while (!$this->dialogOption->getResponses()->isEmpty()) {
            $this->playerDialog($this->dialogOption->getResponses());
        }
    }

    public function playerDialog(PlayerDialogOptionCollection $dialogOptions): void
    {
        $response = $this->playerAction->askForResponse($dialogOptions);

        $this->playerAction->tell("{$this->player->getName()}: {$response}");
        $this->interlocutorDialog($response->getResponse());

        if ($response instanceof QuitDialogOption) {
            $this->dialogOption->getResponses()->clear();
            return;
        }

        $this->dialogOption->getResponses()->remove($response);

        if ($response instanceof FightDialogOption) {
            $this->playerAction->askForConfirmation('Continue?');
            $response->getEvent()($this->player, $this->playerAction);
        }
    }

    public function interlocutorDialog(DialogOption $dialogOption): void
    {
        $this->playerAction->tell("{$this->interlocutor->getName()}: {$dialogOption}");

        if ($dialogOption->getResponses()->isEmpty()) {
            return;
        }

        $this->playerDialog($dialogOption->getResponses());
    }
}
