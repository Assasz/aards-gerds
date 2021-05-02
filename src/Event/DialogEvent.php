<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event;

use AardsGerds\Game\Dialog\Dialog;
use AardsGerds\Game\Dialog\DialogOption;
use AardsGerds\Game\Entity\Entity;
use AardsGerds\Game\Event\Decision\Decision;
use AardsGerds\Game\Event\Decision\DecisionCollection;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

abstract class DialogEvent extends Event
{
    public function __construct(
        Context $context,
        DecisionCollection $decisionCollection,
        protected Entity $subject,
        protected DialogOption $dialogOption,
    ) {
        parent::__construct(
            $context,
            $decisionCollection,
        );
    }

    public function __invoke(Player $player, PlayerAction $playerAction): Decision
    {
        $playerAction->introduce($this->subject->getName());
        $playerAction->tell([(string) $this->context, '']);

        (new Dialog($player, $this->subject, $this->dialogOption, $playerAction))();
        $playerAction->askForConfirmation('Continue?');

        return $playerAction->askForDecision('Where do you want to go?', $this->decisionCollection);
    }

    public function getSubject(): Entity
    {
        return $this->subject;
    }
}
