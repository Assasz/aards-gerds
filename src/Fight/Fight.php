<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

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
    public static function invoke(
        Player $player,
        FighterCollection $opponents,
        PlayerAction $playerAction,
    ): void {
        $round = new IntegerValue(1);

        while ($opponents->count() > 0) {
            $fighters = new FighterCollection(
                array_merge([$player], $opponents->getItems()),
            );

            $playerAction->section("Round {$round}:");
            $playerAction->list(map(
                static fn(Fighter $fighter) => [$fighter->getName() => "{$fighter->getHealth()} health"],
                $fighters,
            ));

            try {
                foreach ($fighters->orderByInitiative() as $fighter) {
                    self::action($fighter, $player, $opponents, $playerAction);
                }
            } catch (IntegerValueException) {
                $isDead = static fn(Fighter $fighter): bool => $fighter->getHealth()->isLowerThan(new Health(1));

                if ($isDead($player)) {
                    throw PlayerException::death();
                }

                $opponents = $opponents->filter(not($isDead));
            }

            $round->increment();
        }
    }

    private static function action(
        Fighter $fighter,
        Player $player,
        FighterCollection $opponents,
        PlayerAction $playerAction,
    ): void {
        if ($fighter instanceof Player) {
            $action = self::askForAction($fighter, $playerAction);

            if ($action instanceof Usable) {
                $action->use($fighter, $playerAction);
                return;
            }
        } else {
            $action = $fighter->getTalents()->randomAttack(); // careful with etherum attacks
        }

        if ($action instanceof EtherumAttack) {
            $fighter->getEtherum()->decreaseBy($action::getEtherumCost());
        }

        Clash::invoke(
            $fighter,
            self::findOpponent($fighter, $player, $opponents, $playerAction),
            $action,
            $playerAction,
        );
    }

    private static function askForAction(Player $player, PlayerAction $playerAction): Attack|Usable
    {
        $action = $playerAction->askForChoice(
            'Select action',
            array_merge($player->getTalents()->filterAttacks()->getItems(), ['Go to inventory']),
        );

        if ($action === 'Go to inventory') {
            $action = $playerAction->askForChoice(
                'Select item to use',
                array_merge($player->getInventory()->filterUsable()->getItems(), ['Back']),
            );

            if ($action === 'Back') {
                return self::askForAction($player, $playerAction);
            }
        }

        return self::validateAction($action, $player, $playerAction);
    }

    private static function validateAction(
        Attack|Usable $action,
        Player $player,
        PlayerAction $playerAction,
    ): Attack|Usable {
        if ($action instanceof MeleeAttack && $player->getWeapon() === null) {
            $playerAction->note('This attack requires weapon equipped.');
            return self::askForAction($player, $playerAction);
        }

        if ($action instanceof EtherumAttack && $player->getEtherum()->isLowerThan($action::getEtherumCost())) {
            $playerAction->note('You do not posses enough Etherum.');
            return self::askForAction($player, $playerAction);
        }

        return $action;
    }

    private static function findOpponent(
        Fighter $fighter,
        Player $player,
        FighterCollection $opponents,
        PlayerAction $playerAction,
    ): Fighter {
        return match (true) {
            $fighter instanceof Player && $opponents->count() > 1
                => $playerAction->askForChoice('Select opponent to attack', $opponents->getItems()),
            $fighter instanceof Player => $opponents->first(),
            default => $player, // @todo: support player parties
        };
    }
}
