<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\SecretKnowledge\FirstAscension;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Talent\Effect\BlockImmunity;
use AardsGerds\Game\Build\Talent\Effect\EffectCollection;
use AardsGerds\Game\Build\Talent\Effect\Stun;
use AardsGerds\Game\Build\Talent\SecretKnowledge\Ascension;
use AardsGerds\Game\Build\Talent\SecretKnowledge\SecretKnowledgeTalent;
use AardsGerds\Game\Build\Talent\TalentPoints;
use AardsGerds\Game\Fight\EtherumAttack;

final class Haze implements EtherumAttack, SecretKnowledgeTalent
{
    public function getDamage(): Damage
    {
        return new Damage(0);
    }

    public function getEffects(): EffectCollection
    {
        return new EffectCollection([new Stun()]);
    }

    public static function getEtherumCost(): Etherum
    {
        return new Etherum(1);
    }

    public static function getName(): string
    {
        return 'Haze';
    }

    public static function getDescription(): string
    {
        return 'Gives your enemy a break.';
    }

    public static function getRequiredTalentPoints(): TalentPoints
    {
        return new TalentPoints(2);
    }

    public static function getRequiredAscension(): Ascension
    {
        return Ascension::firstAscension();
    }
}
