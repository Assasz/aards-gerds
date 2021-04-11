<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent\WeaponMastery;

use AardsGerds\Game\Build\Talent\Talent;
use AardsGerds\Game\Build\Talent\TalentPoints;
use AardsGerds\Game\Inventory\Weapon\WeaponType;

final class WeaponMastery implements Talent, \Stringable
{
    public const NAME = 'Weapon Mastery';

    private function __construct(
        private WeaponType $type,
        private WeaponMasteryLevel $level,
    ) {}

    public static function shortSword(WeaponMasteryLevel $level): self
    {
        return new self(WeaponType::shortSword(), $level);
    }

    public static function greatSword(WeaponMasteryLevel $level): self
    {
        return new self(WeaponType::greatSword(), $level);
    }

    public static function bow(WeaponMasteryLevel $level): self
    {
        return new self(WeaponType::bow(), $level);
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getType(): WeaponType
    {
        return $this->type;
    }

    public function getLevel(): WeaponMasteryLevel
    {
        return $this->level;
    }

    public function getRequiredTalentPoints(): TalentPoints
    {
        return new TalentPoints(4);
    }

    public function __toString(): string
    {
        return "Mastery at {$this->type}: {$this->level}";
    }
}