<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\WoodsTravel;

use AardsGerds\Game\Event\Context;

final class WoodsTravelContext implements Context
{
    public function __toString(): string
    {
        return 'Woods are dark and deep. Better no to fuck around any longer and move on.';
    }
}
