<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story;

use AardsGerds\Game\Event\Event;
use AardsGerds\Game\Player\PlayerAction;

final class Story
{
    public static function continue(Event $event, PlayerAction $playerAction): void
    {
        $decision = $event($playerAction);
        self::continue($decision(), $playerAction);
    }
}
