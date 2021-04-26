<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\Natural;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Talent\Effect\EffectCollection;
use AardsGerds\Game\Build\Talent\Talent;
use AardsGerds\Game\Build\Talent\TalentPoints;
use AardsGerds\Game\Fight\NaturalAttack;

final class DoubleClaw implements NaturalAttack, Talent
{
    public function getEffects(): EffectCollection
    {
        return new EffectCollection([]);
    }

    public function getDamage(): Damage
    {
        return new Damage(10);
    }

    public static function getName(): string
    {
        return 'Double Claw';
    }

    public static function getDescription(): string
    {
        return 'Attack with double claws.';
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
