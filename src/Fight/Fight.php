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

    /**
     * @throws IntegerValueException if target's health hits 0
     */
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

        $damage = $this->calculateDamage($action, $fighter);

        try {
            $this->findOpponent($fighter)->getHealth()->decreaseBy($damage);
        } catch (IntegerValueException $exception) {
            $this->playerAction->tell("{$fighter->getName()} uses {$action} and deals {$damage} damage, which brings opponent to their knees!");
            throw $exception;
        }

        $this->playerAction->tell("{$fighter->getName()} uses {$action} and deals {$damage} damage.");
    }

    private function askForAction(): Attack|Usable
    {
        $action = $this->playerAction->askForChoice(
            'Select action',
            array_merge($this->player->getTalents()->filterAttacks()->getItems(), ['Go to inventory']),
        );

        if ($action === 'Go to inventory') {
            $selectedItem = $this->playerAction->askForChoice(
                'Select item to use',
                array_merge($this->player->getInventory()->filterUsable()->getItems(), ['Back']),
            );

            if ($selectedItem === 'Back') {
                return $this->askForAction();
            }

            return $selectedItem;
        }

        if ($action instanceof MeleeAttack && $this->player->getWeapon() === null) {
            $this->playerAction->note('This attack requires weapon equipped.');
            return $this->askForAction();
        }

        return $action;
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

    private function calculateDamage(Attack $attack, Fighter $fighter): Damage
    {
        return match (true) {
            $attack instanceof MeleeAttack =>
                $attack->getDamage($fighter->getWeapon() ?? throw FightException::weaponRequired())
                    ->increaseBy($fighter->getStrength()),
            $attack instanceof EtherumAttack => $attack->getDamage(),
            default => new Damage(0),
        };
    }
}
