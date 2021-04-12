<?php

declare(strict_types=1);

namespace AardsGerds\Game\Player;

use AardsGerds\Game\Build\Attribute\AttributePoints;
use AardsGerds\Game\Build\Level;
use AardsGerds\Game\Build\LevelProgress;
use AardsGerds\Game\Build\Talent\TalentPoints;

final class Player
{
    public function __construct(
        private string $name,
        private Level $level,
        private LevelProgress $levelProgress,
        private AttributePoints $attributePoints,
        private TalentPoints $talentPoints,
    ) {}

    public function increaseExperience(): void
    {

    }

    public function levelUp(): void
    {
        $this->level->increment();
        $this->levelProgress->reset();
        $this->attributePoints->increaseBy(new AttributePoints(5));
        $this->talentPoints->increaseBy(new TalentPoints(3));
    }
}
