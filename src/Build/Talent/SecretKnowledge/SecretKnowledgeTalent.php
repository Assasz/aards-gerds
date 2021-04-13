<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\SecretKnowledge;

use AardsGerds\Game\Build\Talent\Talent;

interface SecretKnowledgeTalent extends Talent
{
    public static function getRequiredAscension(): Ascension;
}
