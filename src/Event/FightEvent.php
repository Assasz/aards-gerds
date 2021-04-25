<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Build\Experience;
use AardsGerds\Game\Entity\Entity;
use AardsGerds\Game\Fight\Fight;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

abstract class FightEvent extends Event
{
    public function __construct(
        Context $context,
        DecisionCollection $decisionCollection,
        Player $player,
        protected Entity $subject,
        protected Experience $experience,
    ) {
        parent::__construct(
            EventType::fight(),
            $context,
            $decisionCollection,
            $player,
        );
    }

    public function __invoke(PlayerAction $playerAction): Decision
    {
        $playerAction->tell((string) $this->context);

        (new Fight($this->player, $this->subject, $playerAction))();

        $this->player->increaseExperience($this->experience, $playerAction);
        $playerAction->askForConfirmation('Continue?');

        // travel, loot or dialog?
        return $playerAction->askForDecision(
            "{$this->subject->getName()} corpse is lying at your feet. What's next?",
            $this->decisionCollection,
        );
    }
}
