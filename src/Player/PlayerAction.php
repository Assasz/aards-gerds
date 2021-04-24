<?php

declare(strict_types=1);

namespace AardsGerds\Game\Player;

use AardsGerds\Game\Event\Decision;
use AardsGerds\Game\Event\DecisionCollection;

interface PlayerAction
{
    public function askForDecision(string $question, DecisionCollection $decisions): Decision;

    /**
     * @param \Stringable[] $choices
     */
    public function askForChoice(string $question, array $choices): \Stringable;

    public function askForInformation(string $question): string;

    public function askForConfirmation(string $question): bool;

    public function tell(string|array $message): void;

    public function newTour(string $message): void;

    public function note(string $message): void;
}
