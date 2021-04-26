<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Inventory\Usable;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;
use AardsGerds\Game\Player\PlayerException;
use AardsGerds\Game\Shared\IntegerValue;
use AardsGerds\Game\Shared\IntegerValueException;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\not;

final class Fight
{
    private IntegerValue $round;

    public function __construct(
        private Player $player,
        private FighterCollection $opponents,
        private PlayerAction $playerAction,
    ) {
        $this->round = new IntegerValue(1);
    }

    public function __invoke(): void
    {
        while ($this->opponents->count() > 0) {
            $fighters = new FighterCollection(
                array_merge([$this->player], $this->opponents->getItems()),
            );

            $this->playerAction->newRound("Round {$this->round}:");
            $this->playerAction->list(map(
                static fn(Fighter $fighter) => [$fighter->getName() => "{$fighter->getHealth()} health"],
                $fighters,
            ));

            try {
                foreach ($fighters->order() as $fighter) {
                    $this->action($fighter);
                }
            } catch (IntegerValueException $exception) {
                $isDead = static fn(Fighter $fighter): bool => $fighter->getHealth()->isLowerThan(new Health(1));

                if ($isDead($this->player)) {
                    throw PlayerException::death();
                }

                $this->opponents = $this->opponents->filter(not($isDead));
            }

            $this->round->increment();
        }
    }

    private function action(Fighter $fighter): void
    {
        if ($fighter instanceof Player) {
            $action = $this->askForAction();

            if ($action instanceof Usable) {
                $action->use($fighter, $this->playerAction);
                return;
            }
        } else {
            $action = $fighter->getTalents()->filterAttacks()->getIterator()->current();
        }

        AttackAction::invoke($fighter, $this->findOpponent($fighter), $action, $this->playerAction);
    }

    private function askForAction(): Attack|Usable
    {
        $action = $this->playerAction->askForChoice(
            'Select action',
            array_merge($this->player->getTalents()->filterAttacks()->getItems(), ['Go to inventory']),
        );

        if ($action === 'Go to inventory') {
            return $this->askForUsable();
        }

        if ($action instanceof MeleeAttack && $this->player->getWeapon() === null) {
            $this->playerAction->note('This attack requires weapon equipped.');
            return $this->askForAction();
        }

        if ($action instanceof EtherumAttack) {
            if ($this->player->getEtherum()->isLowerThan($action::getEtherumCost())) {
                $this->playerAction->note('You do not posses enough Etherum.');
                return $this->askForAction();
            }

            $this->player->getEtherum()->decreaseBy($action::getEtherumCost());
        }

        return $action;
    }

    private function askForUsable(): Attack|Usable
    {
        $selectedItem = $this->playerAction->askForChoice(
            'Select item to use',
            array_merge($this->player->getInventory()->filterUsable()->getItems(), ['Back']),
        );

        if ($selectedItem === 'Back') {
            return $this->askForAction();
        }

        return $selectedItem;
    }

    private function findOpponent(Fighter $fighter): Fighter
    {
        if ($fighter instanceof Player) {
            return $this->opponents->count() > 1
                ? $this->playerAction->askForChoice('Select opponent to attack', $this->opponents->getItems())
                : $this->opponents->getIterator()->current();
        }

        return $this->player;
    }
}
