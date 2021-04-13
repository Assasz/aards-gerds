<?php

declare(strict_types=1);

namespace AardsGerds\Game\Player;

use AardsGerds\Game\Build\Attribute\AttributePoints;
use AardsGerds\Game\Build\Experience;
use AardsGerds\Game\Build\Level;
use AardsGerds\Game\Build\LevelProgress;
use AardsGerds\Game\Build\Talent\TalentPoints;

final class Player
{
    public function __construct(
        private string $name,
        private LevelProgress $levelProgress,
        private AttributePoints $attributePoints,
        private TalentPoints $talentPoints,
    ) {}

    public static function denormalize(array $data): self
    {
        return new self(
            $data['name'],
            new LevelProgress(
                new Level($data['level']),
                new Experience($data['current_experience']),
            ),
            new AttributePoints($data['attribute_points']),
            new TalentPoints($data['talent_points']),
        );
    }

    public function normalize(): array
    {
        return [
            'name' => $this->name,
            'level' => $this->levelProgress->getLevel()->get(),
            'current_experience' => $this->levelProgress->getCurrentExperience()->get(),
            'attribute_points' => $this->attributePoints->get(),
            'talent_points' => $this->talentPoints->get(),
        ];
    }

    public function increaseExperience(Experience $experience): void
    {
        $this->levelProgress->increase($experience, $this);
    }

    public function getAttributePoints(): AttributePoints
    {
        return $this->attributePoints;
    }

    public function getTalentPoints(): TalentPoints
    {
        return $this->talentPoints;
    }
}
