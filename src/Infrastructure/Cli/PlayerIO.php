<?php

declare(strict_types=1);

namespace AardsGerds\Game\Infrastructure\Cli;

use AardsGerds\Game\Event\Decision;
use AardsGerds\Game\Event\DecisionCollection;
use AardsGerds\Game\Infrastructure\Persistence\PlayerState;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;
use Symfony\Component\Console\Style\SymfonyStyle;

final class PlayerIO implements PlayerAction
{
    public function __construct(
        private SymfonyStyle $io,
        private PlayerState $playerState,
    ) {}

    public function savePlayerState(Player $player): void
    {
        $this->playerState->save($player);
    }

    public function askForDecision(string $question, DecisionCollection $decisions): Decision
    {
        $this->clearOutput();
        return $this->io->choice($question, $decisions->getItems());
    }

    public function askForChoice(string $question, array $choices): mixed
    {
        return $this->io->choice($question, $choices);
    }

    public function askForInformation(string $question): string
    {
        return $this->io->ask($question);
    }

    public function askForConfirmation(string $question): bool
    {
        return $this->io->confirm($question);
    }

    public function tell(string|array $message): void
    {
        sleep(1);
        $this->io->text($message);
    }

    public function list(array $items): void
    {
        sleep(1);
        $this->io->definitionList(...$items);
    }

    public function introduce(string $message): void
    {
        sleep(1);
        $this->io->title($message);
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
