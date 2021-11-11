<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Build\Experience;
use AardsGerds\Game\Entity\Entity;
use AardsGerds\Game\Entity\EntityCollection;
use AardsGerds\Game\Event\Decision\Decision;
use AardsGerds\Game\Event\Decision\DecisionCollection;
use AardsGerds\Game\Fight\Fight;
use AardsGerds\Game\Fight\FighterCollection;
use AardsGerds\Game\Inventory\Inventory;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;
use function Lambdish\Phunctional\map;

abstract class FightEvent extends Event
{
    public function __construct(
        Context $context,
        DecisionCollection $decisionCollection,
        protected EntityCollection $subjects,
        protected Experience $experience,
    ) {
        parent::__construct(
            $context,
            $decisionCollection,
        );
    }

    public function __invoke(Player $player, PlayerAction $playerAction): Decision
    {
        $playerAction->tell((string) $this->context);

        Fight::invoke($player, new FighterCollection($this->subjects), $playerAction);

        $player->increaseExperience($this->experience, $playerAction);

        if ($playerAction->askForConfirmation('Do you want to loot?')) {
            $lootInventory = new Inventory(
                array_merge(...map(
                    static fn(Entity $subject): array => $subject->getInventory()->getItems(),
                    $this->subjects,
                )),
            );

            $this->loot($player, $playerAction, $lootInventory);
        }

        return $playerAction->askForDecision(
            "Fight is over. What's next?",
            $this->decisionCollection,
        );
    }

    private function loot(Player $player, PlayerAction $playerAction, Inventory $lootInventory): void
    {
        $playerAction->listInventory($lootInventory);

        $choice = $playerAction->askForChoice(
            'Your choice',
            array_merge($lootInventory->getItems(), ['Take all', 'Leave']),
        );

        if ($choice === 'Leave') {
            return;
        }

        if ($choice === 'Take all') {
            $player->getInventory()->addMany(...$lootInventory->getItems());
            $playerAction->tell('You have obtained some new items');

            return;
        }

        $player->getInventory()->add($choice);
        $lootInventory->remove($choice);

        $playerAction->tell("You have obtained {$choice}");

        if (!$lootInventory->isEmpty()) {
            $this->loot($player, $playerAction, $lootInventory);
        }
    }
}
