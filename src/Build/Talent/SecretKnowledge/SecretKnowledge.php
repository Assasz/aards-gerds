<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\SecretKnowledge;

use AardsGerds\Game\Build\Talent\Talent;
use AardsGerds\Game\Build\Talent\TalentPoints;

final class SecretKnowledge implements Talent, \Stringable
{
    public function __construct(
        private Ascension $ascension,
    ) {}

    public static function getName(): string
    {
        return 'Secret Knowledge';
    }

    public static function getRequiredTalentPoints(): TalentPoints
    {
        return new TalentPoints(6);
    }

    public function __toString(): string
    {
        return "Secret Knowledge at {$this->ascension}";
    }
}