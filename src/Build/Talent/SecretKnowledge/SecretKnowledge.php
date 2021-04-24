<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\SecretKnowledge;

use AardsGerds\Game\Build\Talent\Talent;
use AardsGerds\Game\Build\Talent\TalentPoints;

final class SecretKnowledge implements Talent
{
    public function __construct(
        private Ascension $ascension,
    ) {}

    public function getAscension(): Ascension
    {
        return $this->ascension;
    }

    public static function getName(): string
    {
        return 'Secret Knowledge';
    }

    public static function getDescription(): string
    {
        return 'Also known as Etheurgy is some places. Art of Etherum wielding.';
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
