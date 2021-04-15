<?php

declare(strict_types=1);

namespace AardsGerds\Game\Event\Story\FirstChapter\WolfEncounter;

use AardsGerds\Game\Event\Context;

final class WolfEncounterContext implements Context
{
    public function __toString(): string
    {
        return "Big wolf is hiding in the woods nearby. Definitely he's looking for it's prey.";
    }
}
