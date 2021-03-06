<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent;

interface Talent extends \Stringable
{
    public static function getName(): string;

    public static function getDescription(): string;

    public static function getRequiredTalentPoints(): TalentPoints;
}
