<?php

declare(strict_types=1);

namespace AardsGerds\Game\Infrastructure\Cli;

use AardsGerds\Game\Event\Decision;
use AardsGerds\Game\Event\DecisionCollection;
use AardsGerds\Game\Player\PlayerAction;
use Symfony\Component\Console\Style\SymfonyStyle;

final class PlayerIO implements PlayerAction
{
    public function __construct(
        private SymfonyStyle $io,
    ) {}

    public function askForDecision(string $question, DecisionCollection $decisions): Decision
    {
        $this->clearOutput();
        return $this->io->choice($question, $decisions->getItems());
    }

    public function askForInformation(string $question): string
    {
        $this->clearOutput();
        return $this->io->ask($question);
    }

    public function askForConfirmation(string $question): bool
    {
        $this->clearOutput();
        return $this->io->confirm($question);
    }

    public function note(string $message): void
    {
        $this->io->note($message);
    }

    private function clearOutput(): void
    {
        $this->io->write("\033\143");
    }
}