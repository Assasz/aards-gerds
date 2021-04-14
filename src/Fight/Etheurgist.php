<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Talent\SecretKnowledge\Ascension;

interface Etheurgist
{
    public function getEtherum(): Etherum;

    public function getAscension(): Ascension;
}
