<?php

declare(strict_types=1);

namespace AardsGerds\Game\Player;

use AardsGerds\Game\Event\Decision\Decision;
use AardsGerds\Game\Event\Decision\DecisionCollection;
use AardsGerds\Game\Inventory\Inventory;

interface PlayerAction
{
    public function savePlayerState(Player $player): void;

    public function askForDecision(string $question, DecisionCollection $decisions): Decision;

    public function askForChoice(string $question, array $choices): mixed;

    public function askForInformation(string $question): string;

    public function askForConfirmation(string $question): bool;

    public function tell(string|array $message): void;

    public function list(array $items): void;

    public function listInventory(Inventory $inventory): void;

    public function introduce(string $message): void;

    public function section(string $message): void;

    public function note(string $message): void;
}
