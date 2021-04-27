<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Location\Town\Town;
use AardsGerds\Game\Location\Town\Visitor;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;
use function Lambdish\Phunctional\map;

abstract class TownVisitEvent extends Event
{
    public function __construct(
        Context $context,
        DecisionCollection $decisionCollection,
        protected Town $town,
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

        $playerAction->introduce($this->town->getName());
        $playerAction->tell((string) $this->context);

        $visitors = $this->town->getVisitors();
        $playerAction->list(map(
            static fn(Visitor $visitor): array => [$visitor->getName() => (string) $visitor->getRole()],
            $visitors,
        ));

        $playerAction->askForConfirmation('Continue?');

        // travel
        return $playerAction->askForDecision('question', $this->decisionCollection);
    }
}
