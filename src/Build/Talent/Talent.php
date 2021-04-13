<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent;

use AardsGerds\Game\Build\Talent\TalentPoints;

interface Talent
{
    public static function getName(): string;

    public static function getRequiredTalentPoints(): TalentPoints;
}
