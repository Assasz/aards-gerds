<?php

declare(strict_types=1);

namespace AardsGerds\Game\Infrastructure\Cli;

use AardsGerds\Game\Entity\Entity;
use AardsGerds\Game\Event\Decision\Decision;
use AardsGerds\Game\Event\Decision\DecisionCollection;
use AardsGerds\Game\Infrastructure\Persistence\PlayerState;
use AardsGerds\Game\Inventory\Inventory;
use AardsGerds\Game\Inventory\InventoryItem;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;
use Symfony\Component\Console\Style\SymfonyStyle;
use function Lambdish\Phunctional\map;

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

    public function listInventory(Inventory $inventory): void
    {
        $this->io->table(
            ['Name', 'Description', 'Sell Value', 'Buy Value'],
            [...map(
                static fn(InventoryItem $inventoryItem): array => [
                    $inventoryItem->getName(),
                    $inventoryItem->getDescription(),
                    $inventoryItem->getSellValue(),
                    $inventoryItem->getBuyValue(),
                ],
                $inventory,
            )],
        );
    }

    public function introduce(string $message): void
    {
        sleep(1);
        $this->clearOutput();
        $this->io->title($message);
        sleep(1);
    }

    public function section(string $message): void
    {
        sleep(1);
        $this->io->section($message);
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
