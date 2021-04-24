<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Initiative;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;
use AardsGerds\Game\Shared\IntegerValue;
use AardsGerds\Game\Shared\IntegerValueException;

final class Fight
{
    private IntegerValue $round;

    public function __construct(
        private Fighter $player,
        private Fighter $opponent,
    ) {
        $this->round = new IntegerValue(1);
    }

    public function __invoke(PlayerAction $playerAction): Fighter
    {
        $playerInitialHealth = new Health($this->player->getHealth()->get());
        $opponentInitialHealth = new Health($this->opponent->getHealth()->get());

        while (true) {
            $playerAction->newTour("Round {$this->round}:");
            $attackOrder = AttackOrder::resolve($this->player, $this->opponent);

            try {
                $this->attack($playerAction, $attackOrder->first(), $attackOrder->last());
                if ($this->isAbleForExtraAttack($attackOrder->first(), $attackOrder->last())) {
                    $this->attack($playerAction, $attackOrder->first(), $attackOrder->last());
                }

                $this->attack($playerAction, $attackOrder->last(), $attackOrder->first());
            } catch (IntegerValueException $exception) {
                // someone died
                break;
            }

            $playerAction->tell([
                '',
                "{$this->player->getName()} health: {$this->player->getHealth()}",
                "{$this->opponent->getName()} health: {$this->opponent->getHealth()}",
            ]);

            $this->round->increment();
        }

        $winner = $this->player->getHealth()->isGreaterThan($this->opponent->getHealth())
            ? $this->player
            : $this->opponent;

        $playerAction->tell("Winner is {$winner->getName()}");
        $playerAction->askForConfirmation('Continue?');

        $this->player->getHealth()->replaceWith($playerInitialHealth);
        $this->opponent->getHealth()->replaceWith($opponentInitialHealth);

        return $winner;
    }

    /**
     * @throws IntegerValueException if target's health drop below 0
     */
    private function attack(PlayerAction $playerAction, Fighter $attacker, Fighter $target): void
    {
        /** @var Attack $attack */
        $attack = $attacker instanceof Player
            ? $this->askForAction($playerAction, $attacker)
            : $attacker->getTalents()->filterAttacks()->getIterator()->current(); // todo

        $damage = match (true) {
            $attack instanceof MeleeAttack => $attack->getDamage(
                $attacker->getWeapon() ?? throw FightException::weaponRequired(),
            ),
            $attack instanceof EtherumAttack => $attack->getDamage(),
            default => new Damage(0),
        };

        try {
            $target->getHealth()->decreaseBy($damage);
        } catch (IntegerValueException $exception) {
            $playerAction->tell("{$attacker->getName()} uses {$attack} and deals {$damage} damage, which brings opponent to their knees!");
            throw $exception;
        }

        $playerAction->tell("{$attacker->getName()} uses {$attack} and deals {$damage} damage.");
    }

    private function isAbleForExtraAttack(Fighter $attacker, Fighter $target): bool
    {
        return (new Initiative((int) $attacker->getInitiative()->get() / 2))
            ->isGreaterThan($target->getInitiative());
    }

    private function askForAction(PlayerAction $playerAction, Player $player): Attack
    {
        /** @var Attack $attack */
        $attack = $playerAction->askForChoice(
            'Select action',
            $player->getTalents()->filterAttacks()->getItems(),
        );

        if ($attack instanceof MeleeAttack && $player->getWeapon() === null) {
            $playerAction->note('This attack requires weapon equipped.');
            return $this->askForAction($playerAction, $player);
        }

        return $attack;
    }
}
