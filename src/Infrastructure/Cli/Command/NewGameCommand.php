<?php

declare(strict_types=1);

namespace AardsGerds\Game\Infrastructure\Cli\Command;

use AardsGerds\Game\Event\Story\FirstChapter\WolfEncounter\WolfEncounterEvent;
use AardsGerds\Game\Event\Story\Story;
use AardsGerds\Game\Infrastructure\Cli\PlayerIO;
use AardsGerds\Game\Player\Player;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class NewGameCommand extends Command
{
    protected static $defaultName = 'game:new';

    protected function configure(): void
    {
        $this->setDescription('This command starts new game');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $playerIO = new PlayerIO(new SymfonyStyle($input, $output));
        $player = Player::new($playerIO->askForInformation('Choose player name'));

        Story::continue(new WolfEncounterEvent($player), $playerIO);

        return Command::SUCCESS;
    }
}
