<?php

declare(strict_types=1);

namespace AardsGerds\Game\Infrastructure\Cli\Command;

use AardsGerds\Game\Infrastructure\Cli\PlayerInput;
use AardsGerds\Game\Infrastructure\Persistence\PlayerState;
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

        $player = $this->playerState->load($playerName);
        $playerInput = new PlayerInput(new SymfonyStyle($input, $output));

        return Command::SUCCESS;
    }
}
