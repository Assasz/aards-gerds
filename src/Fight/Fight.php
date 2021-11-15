<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Inventory\Consumable;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;
use AardsGerds\Game\Player\PlayerException;
use AardsGerds\Game\Shared\IntegerValue;
use AardsGerds\Game\Shared\IntegerValueException;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\not;

final class Fight
{
    public function __construct(
        private Player $player,
        private FighterCollection $opponents,
    ) {}

    public function __invoke(PlayerAction $playerAction): void
    {
        $round = new IntegerValue(1);

        while ($this->opponents->count() > 0) {
            $fighters = new FighterCollection(
                array_merge([$this->player], $this->opponents->getItems()),
            );

            $playerAction->section("Round {$round}:");
            $playerAction->list(map(
                static fn(Fighter $fighter) => [$fighter->getName() => "{$fighter->getHealth()} health"],
                $fighters,
            ));

            try {
                foreach ($fighters->orderByInitiative() as $fighter) {
                    $this->action($fighter, $playerAction);
                }
            } catch (IntegerValueException) {
                $isDead = static fn(Fighter $fighter): bool => $fighter->getHealth()->isLowerThan(new Health(1));

                if ($isDead($this->player)) {
                    throw PlayerException::death();
                }

                $this->opponents = $this->opponents->filter(not($isDead));
            }

            $round->increment();
        }
    }

    private function action(Fighter $fighter, PlayerAction $playerAction): void
    {
        if ($fighter instanceof Player) {
            $action = $this->askForPlayerAction($playerAction);

            if ($action instanceof Consumable) {
                $action->consume($fighter, $playerAction);
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
            $this->findOpponent($fighter, $playerAction),
            $action,
            $playerAction,
        );
    }

    private function askForPlayerAction(PlayerAction $playerAction): Attack|Consumable
    {
        $action = $playerAction->askForChoice(
            'Select action',
            array_merge($this->player->getTalents()->filterAttacks()->getItems(), ['Go to inventory']),
        );

        if ($action === 'Go to inventory') {
            $action = $playerAction->askForChoice(
                'Select item to use',
                array_merge($this->player->getInventory()->filterConsumable()->getItems(), ['Back']),
            );

            if ($action === 'Back') {
                return $this->askForPlayerAction($playerAction);
            }
        }

        return $this->validatePlayerAction($action, $playerAction);
    }

    private function validatePlayerAction(
        Attack|Consumable $action,
        PlayerAction $playerAction,
    ): Attack|Consumable {
        if ($action instanceof MeleeAttack && $this->player->getWeapon() === null) {
            $playerAction->note('This attack requires weapon equipped.');
            return $this->askForPlayerAction($playerAction);
        }

        if ($action instanceof EtherumAttack && $this->player->getEtherum()->isLowerThan($action::getEtherumCost())) {
            $playerAction->note('You do not posses enough Etherum.');
            return $this->askForPlayerAction($playerAction);
        }

        return $action;
    }

    private function findOpponent(Fighter $fighter, PlayerAction $playerAction): Fighter
    {
        return match (true) {
            $fighter instanceof Player && $this->opponents->count() > 1
                => $playerAction->askForChoice('Select opponent to attack', $this->opponents->getItems()),
            $fighter instanceof Player => $this->opponents->first(),
            default => $this->player, // @todo: support player parties
        };
    }
}
