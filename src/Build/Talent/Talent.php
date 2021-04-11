<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent;

use AardsGerds\Game\Build\Talent\TalentPoints;

interface Talent
{
    public function getName(): string;

    public function getRequiredTalentPoints(): TalentPoints;
}
