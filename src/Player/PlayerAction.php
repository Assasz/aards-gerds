<?php

declare(strict_types=1);

namespace AardsGerds\Game\Player;

use AardsGerds\Game\Event\Decision;
use AardsGerds\Game\Event\DecisionCollection;

interface PlayerAction
{
    public function savePlayerState(Player $player): void;

    public function askForDecision(string $question, DecisionCollection $decisions): Decision;

    public function askForChoice(string $question, array $choices): mixed;

    public function askForInformation(string $question): string;

    public function askForConfirmation(string $question): bool;

    public function tell(string|array $message): void;

    public function list(array $items): void;

    public function introduce(string $message): void;

    public function note(string $message): void;
}
