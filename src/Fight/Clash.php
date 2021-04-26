<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Player\PlayerAction;
use AardsGerds\Game\Shared\IntegerValueException;

final class Clash
{
    /**
     * @throws IntegerValueException if target's health hits 0
     */
    public static function invoke(
        Fighter $attacker,
        Fighter $target,
        Attack $attack,
        PlayerAction $playerAction,
    ): void {
        if (self::blockOccurred($attacker, $target, $attack)) {
            $playerAction->tell("{$attacker->getName()} uses {$attack}, but {$target->getName()} has blocked this attack.");
            return;
        }

        $damage = self::calculateDamage($attacker, $attack);

        try {
            $target->getHealth()->decreaseBy($damage);
        } catch (IntegerValueException $exception) {
            $playerAction->tell("{$attacker->getName()} uses {$attack} and deals {$damage} damage, which brings opponent to their knees!");
            throw $exception;
        }

        $playerAction->tell("{$attacker->getName()} uses {$attack} and deals {$damage} damage.");
    }

    private static function calculateDamage(
        Fighter $attacker,
        Attack $attack,
    ): Damage {
        return match (true) {
            $attack instanceof MeleeAttack =>
                (new Damage(0))
                    ->increaseBy($attack->getDamage($attacker->getWeapon()
                        ?? throw FightException::weaponRequired()))
                    ->increaseBy($attacker->getStrength()),
            $attack instanceof EtherumAttack => $attack->getDamage(),
            default => new Damage(0),
        };
    }

    private static function blockOccurred(
        Fighter $attacker,
        Fighter $target,
        Attack $attack,
    ): bool {
        return self::occurred(Block::calculateChance($attacker, $target, $attack));
    }

    private static function occurred(float $chance): bool
    {
        return mt_rand(1, 10000) <= $chance * 10000;
    }
}
