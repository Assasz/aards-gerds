<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Initiative;
use AardsGerds\Game\Inventory\Usable;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;
use AardsGerds\Game\Player\PlayerException;
use AardsGerds\Game\Shared\IntegerValue;
use AardsGerds\Game\Shared\IntegerValueException;

final class Fight
{
    private IntegerValue $round;

    public function __construct(
        private Fighter $player,
        private Fighter $opponent,
        private PlayerAction $playerAction,
    ) {
        $this->round = new IntegerValue(1);
    }

    public function __invoke(): void
    {
        $playerInitialHealth = new Health($this->player->getHealth()->get());

        while (true) {
            $this->playerAction->newRound("Round {$this->round}:");
            $attackOrder = AttackOrder::resolve($this->player, $this->opponent); // todo refactor

            try {
                $this->action($attackOrder->first(), $attackOrder->last());
                if ($this->isAbleForExtraAction($attackOrder->first(), $attackOrder->last())) {
                    $this->action($attackOrder->first(), $attackOrder->last());
                }

                $this->action($attackOrder->last(), $attackOrder->first());
            } catch (IntegerValueException $exception) {
                if ($this->player->getHealth()->isLowerThan(new Health(1))) {
                    throw PlayerException::death();
                }

                break;
            }

            $this->playerAction->tell([
                '',
                "{$this->player->getName()} health: {$this->player->getHealth()}",
                "{$this->opponent->getName()} health: {$this->opponent->getHealth()}",
            ]);

            $this->round->increment();
        }

        $this->player->getHealth()->replaceWith($playerInitialHealth);
    }

    /**
     * @throws IntegerValueException if target's health hits 0
     */
    private function action(Fighter $attacker, Fighter $target): void
    {
        if ($attacker instanceof Player) {
            $action = $this->askForAction($attacker);
            if ($action instanceof Usable) {
                $action->use($attacker, $this->playerAction);
                return;
            }
        } else {
            $action = $attacker->getTalents()->filterAttacks()->getIterator()->current(); // todo
        }

        $damage = match (true) {
            $action instanceof MeleeAttack =>
                $action->getDamage($attacker->getWeapon() ?? throw FightException::weaponRequired())
                    ->increaseBy($attacker->getStrength()),
            $action instanceof EtherumAttack => $action->getDamage(),
            default => new Damage(0),
        };

        try {
            $target->getHealth()->decreaseBy($damage);
        } catch (IntegerValueException $exception) {
            $this->playerAction->tell("{$attacker->getName()} uses {$action} and deals {$damage} damage, which brings opponent to their knees!");
            throw $exception;
        }

        $this->playerAction->tell("{$attacker->getName()} uses {$action} and deals {$damage} damage.");
    }

    private function askForAction(Player $player): Attack|Usable
    {
        $action = $this->playerAction->askForChoice(
            'Select action',
            array_merge($player->getTalents()->filterAttacks()->getItems(), ['Go to inventory']),
        );

        if ($action === 'Go to inventory') {
            $selectedItem = $this->playerAction->askForChoice(
                'Select item to use',
                array_merge($player->getInventory()->filterUsable()->getItems(), ['Back']),
            );

            if ($selectedItem === 'Back') {
                return $this->askForAction($player);
            }

            return $selectedItem;
        }

        if ($action instanceof MeleeAttack && $player->getWeapon() === null) {
            $this->playerAction->note('This attack requires weapon equipped.');
            return $this->askForAction($player);
        }

        return $action;
    }

    private function isAbleForExtraAction(Fighter $attacker, Fighter $target): bool
    {
        return (new Initiative((int) $attacker->getInitiative()->get() / 2))
            ->isGreaterThan($target->getInitiative());
    }
}
