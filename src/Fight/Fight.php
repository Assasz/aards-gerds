<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Initiative;
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
            $attackOrder = AttackOrder::resolve($this->player, $this->opponent);

            try {
                $this->attack($attackOrder->first(), $attackOrder->last());
                if ($this->isAbleForExtraAttack($attackOrder->first(), $attackOrder->last())) {
                    $this->attack($attackOrder->first(), $attackOrder->last());
                }

                $this->attack($attackOrder->last(), $attackOrder->first());
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

        $this->playerAction->askForConfirmation('Continue?');
        $this->player->getHealth()->replaceWith($playerInitialHealth);
    }

    /**
     * @throws IntegerValueException if target's health drop below 0
     */
    private function attack(Fighter $attacker, Fighter $target): void
    {
        /** @var Attack $attack */
        $attack = $attacker instanceof Player
            ? $this->askForAction($attacker)
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
            $this->playerAction->tell("{$attacker->getName()} uses {$attack} and deals {$damage} damage, which brings opponent to their knees!");
            throw $exception;
        }

        $this->playerAction->tell("{$attacker->getName()} uses {$attack} and deals {$damage} damage.");
    }

    private function isAbleForExtraAttack(Fighter $attacker, Fighter $target): bool
    {
        return (new Initiative((int) $attacker->getInitiative()->get() / 2))
            ->isGreaterThan($target->getInitiative());
    }

    private function askForAction(Player $player): Attack
    {
        /** @var Attack $attack */
        $attack = $this->playerAction->askForChoice(
            'Select action',
            $player->getTalents()->filterAttacks()->getItems(),
        );

        if ($attack instanceof MeleeAttack && $player->getWeapon() === null) {
            $this->playerAction->note('This attack requires weapon equipped.');
            return $this->askForAction($player);
        }

        return $attack;
    }
}
