<?php

declare(strict_types=1);

namespace AardsGerds\Game\Infrastructure\Cli\Command;

use AardsGerds\Game\Infrastructure\Cli\PlayerIO;
use AardsGerds\Game\Infrastructure\Persistence\PlayerState;
use AardsGerds\Game\Infrastructure\Persistence\PlayerStateException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class LoadGameCommand extends Command
{
    protected static $defaultName = 'game:load';

    public function __construct(
        private PlayerState $playerState,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('This command loads existing game')
            ->addArgument('player', InputArgument::REQUIRED, 'Player to load');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $playerName = $input->getArgument('player');
        assert(is_string($playerName));

        $playerIO = new PlayerIO(new SymfonyStyle($input, $output), $this->playerState);

        try {
            $player = $this->playerState->load($playerName);
        } catch (PlayerStateException $exception) {
            $playerIO->note("Player {$playerName} doesn't exist.");
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
