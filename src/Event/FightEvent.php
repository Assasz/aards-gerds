<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Build\Experience;
use AardsGerds\Game\Entity\EntityCollection;
use AardsGerds\Game\Fight\Fight;
use AardsGerds\Game\Fight\FighterCollection;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

abstract class FightEvent extends Event
{
    public function __construct(
        Context $context,
        DecisionCollection $decisionCollection,
        protected EntityCollection $subjects,
        protected Experience $experience,
    ) {
        parent::__construct(
            $context,
            $decisionCollection,
        );
    }

    public function __invoke(Player $player, PlayerAction $playerAction): Decision
    {
        $playerAction->tell((string) $this->context);

        (new Fight($player, new FighterCollection($this->subjects), $playerAction))();

        $player->increaseExperience($this->experience, $playerAction);
        $playerAction->askForConfirmation('Continue?');

        // travel, loot or dialog?
        return $playerAction->askForDecision(
            "Fight is over. What's next?",
            $this->decisionCollection,
        );
    }
}
