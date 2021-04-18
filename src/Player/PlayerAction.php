<?php

declare(strict_types=1);

namespace AardsGerds\Game\Player;

use AardsGerds\Game\Event\Decision;
use AardsGerds\Game\Event\DecisionCollection;

interface PlayerAction
{
    public function askForDecision(string $question, DecisionCollection $decisions): Decision;

    public function askForInformation(string $question): int|string;

    public function askForConfirmation(string $question): bool;
}
