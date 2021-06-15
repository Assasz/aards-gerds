<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Entity\Entity;
use AardsGerds\Game\Event\Decision\Decision;
use AardsGerds\Game\Event\Decision\DecisionCollection;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

abstract class TradeEvent extends Event
{
    public function __construct(
        Context $context,
        DecisionCollection $decisionCollection,
        protected Entity $subject,
    ) {
        parent::__construct(
            $context,
            $decisionCollection,
        );
    }

    public function __invoke(Player $player, PlayerAction $playerAction): Decision
    {
        $playerAction->tell([(string) $this->context, '']);

        $this->askForChoice($player, $playerAction);

        return $playerAction->askForDecision('What do you want to do next?', $this->decisionCollection);
    }

    private function askForChoice(Player $player, PlayerAction $playerAction): void
    {
        $choice = $playerAction->askForChoice('What do you want to do?', ['Buy', 'Sell']);

        if ($choice === 'Buy') {
            $playerAction->tell("{$this->subject->getName()}'s inventory:");
            $playerAction->listInventory($this->subject->getInventory());

            $choice = $playerAction->askForChoice(
                'What do you want to buy?',
                array_merge($this->subject->getInventory()->getItems(), ['Back']),
            );
        }

        if ($choice === 'Sell') {
            $playerAction->tell("Your inventory:");
            $playerAction->listInventory($player->getInventory());

            $choice = $playerAction->askForChoice(
                'What do you want to sell?',
                array_merge($player->getInventory()->getItems(), ['Back']),
            );
        }

        if ($choice === 'Back') {
            $this->askForChoice($player, $playerAction);
        }
    }
}
