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
        Player $player,
        protected EntityCollection $subjects,
        protected Experience $experience,
    ) {
        parent::__construct(
            $context,
            $decisionCollection,
            $player,
        );
    }

    public function __invoke(PlayerAction $playerAction): Decision
    {
        $playerAction->tell((string) $this->context);

        (new Fight($this->player, new FighterCollection($this->subjects), $playerAction))();

        $this->player->increaseExperience($this->experience, $playerAction);
        $playerAction->askForConfirmation('Continue?');

        // travel, loot or dialog?
        return $playerAction->askForDecision(
            "Fight is over. What's next?",
            $this->decisionCollection,
        );
    }
}
