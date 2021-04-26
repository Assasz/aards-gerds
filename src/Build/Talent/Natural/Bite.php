<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\Natural;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Talent\Effect\EffectCollection;
use AardsGerds\Game\Build\Talent\Talent;
use AardsGerds\Game\Build\Talent\TalentPoints;
use AardsGerds\Game\Fight\NaturalAttack;

final class Bite implements NaturalAttack, Talent
{
    public function getEffects(): EffectCollection
    {
        return new EffectCollection([]);
    }

    public function getDamage(): Damage
    {
        return new Damage(5);
    }

    public static function getName(): string
    {
        return 'Bite';
    }

    public static function getDescription(): string
    {
        return 'Just a bite.';
    }

    public static function getRequiredTalentPoints(): TalentPoints
    {
        return new TalentPoints(0);
    }

    public function __toString(): string
    {
        return self::getName();
    }
}
