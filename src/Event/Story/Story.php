<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story;

use AardsGerds\Game\Event\Event;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

final class Story
{
    public static function continue(Event $event, Player $player, PlayerAction $playerAction): void
    {
        $decision = $event($player, $playerAction);
        self::continue($decision(), $player, $playerAction);
    }
}
