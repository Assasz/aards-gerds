<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\SecretKnowledge\EighthAscension;

use AardsGerds\Game\Build\Talent\Effect\EffectCollection;
use AardsGerds\Game\Build\Talent\Effect\Immortality;
use AardsGerds\Game\Build\Talent\SecretKnowledge\Ascension;
use AardsGerds\Game\Build\Talent\SecretKnowledge\SecretKnowledgeTalent;
use AardsGerds\Game\Build\Talent\TalentPoints;

final class ProtectionOfTheGods implements SecretKnowledgeTalent
{
    public function getEffects(): EffectCollection
    {
        return new EffectCollection([new Immortality()]);
    }

    public static function getName(): string
    {
        return 'Protection Of The Gods';
    }

    public static function getDescription(): string
    {
        return 'You are immune to mortal wounds and illness.';
    }

    public static function getRequiredTalentPoints(): TalentPoints
    {
        return new TalentPoints(20);
    }

    public static function getRequiredAscension(): Ascension
    {
        return Ascension::eighthAscension();
    }
}
