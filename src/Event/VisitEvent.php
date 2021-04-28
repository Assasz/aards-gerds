<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Location\Location;
use AardsGerds\Game\Location\Visitor;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;
use function Lambdish\Phunctional\map;

abstract class VisitEvent extends Event
{
    public function __construct(
        Context $context,
        DecisionCollection $decisionCollection,
        protected Location $location,
    ) {
        parent::__construct(
            $context,
            $decisionCollection,
        );
    }

    public function __invoke(Player $player, PlayerAction $playerAction): Decision
    {
        $player->setCheckpoint($this);
        $playerAction->savePlayerState($player);

        $playerAction->introduce($this->location->getName());
        $playerAction->tell((string) $this->context);

        $visitors = $this->location->getVisitors();
        if (!$visitors->isEmpty()) {
            $playerAction->list(map(
                static fn(Visitor $visitor): array => [$visitor->getName() => (string) $visitor->getRole()],
                $visitors,
            ));

            $choice = $playerAction->askForChoice(
                'Where do you want to go?',
                array_merge($visitors->getItems(), ['Leave this place']),
            );
        }

        // travel
        return $playerAction->askForDecision('question', $this->decisionCollection);
    }
}
