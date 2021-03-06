<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build;

use AardsGerds\Game\Build\Attribute\AttributePoints;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Talent\TalentPoints;
use AardsGerds\Game\Player\Player;
use AardsGerds\Game\Player\PlayerAction;

final class LevelProgress
{
    private Experience $experienceNeededForNextLevel;

    public function __construct(
        private Level $level,
        private Experience $currentExperience,
    ) {
        $this->calculateExperienceNeededForNextLevel();
    }

    /**
     * @example
     * level: 1
     * current experience: 500
     * experience needed for next level: 1000
     * increase experience by 600
     *
     * expected:
     * level: 2
     * current experience: 1100
     * experience needed for next level: 2000
     */
    public function increase(Experience $experience, Player $player, PlayerAction $playerAction): void
    {
        $this->currentExperience->increaseBy($experience);
        $playerAction->tell("You have gained {$experience} experience!");

        while ($this->currentExperience->isGreaterThanOrEqual($this->experienceNeededForNextLevel)) {
            $this->levelUp($player);
            $playerAction->tell("You have gained new level!");
        }
    }

    public function getLevel(): Level
    {
        return $this->level;
    }

    public function getCurrentExperience(): Experience
    {
        return $this->currentExperience;
    }

    private function levelUp(Player $player): void
    {
        $this->level->increment();
        $this->calculateExperienceNeededForNextLevel();

        $player->getMaximumHealth()->increaseBy(new Health(20));
        $player->getAttributePoints()->increaseBy(new AttributePoints(5));
        $player->getTalentPoints()->increaseBy(new TalentPoints(3));
        $player->healCompletely();
    }

    private function calculateExperienceNeededForNextLevel(): void
    {
        $this->experienceNeededForNextLevel = new Experience(0);

        for ($level = 2; $level <= $this->level->get() + 1; $level++) {
            $this->experienceNeededForNextLevel->increaseBy(self::getRequiredExperience(new Level($level)));
        }
    }

    private static function getRequiredExperience(Level $level): Experience
    {
        return match (true) {
            $level->isGreaterThan(new Level(10)) => new Experience(2000),
            $level->isGreaterThan(new Level(20)) => new Experience(3000),
            default => new Experience(1000),
        };
    }
}
