<?php

declare(strict_types=1);

namespace AardsGerds\Game\Player;

use AardsGerds\Game\Build\Attribute\AttributePoints;
use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Initiative;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Experience;
use AardsGerds\Game\Build\Level;
use AardsGerds\Game\Build\LevelProgress;
use AardsGerds\Game\Build\Talent\SecretKnowledge\Ascension;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Build\Talent\TalentPoints;
use AardsGerds\Game\Build\Talent\WeaponMastery\ShortSword\Novice\Slash;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Entity\Corruption;
use AardsGerds\Game\Entity\Entity;
use AardsGerds\Game\Event\Story\FirstChapter\MercenaryCamp\MercenaryCampVisitEvent;
use AardsGerds\Game\Event\VisitEvent;
use AardsGerds\Game\Inventory\Alchemy\Potion\HealthPotion;
use AardsGerds\Game\Inventory\Inventory;
use AardsGerds\Game\Inventory\Weapon\ShortSword\RustyShortSword;
use AardsGerds\Game\Inventory\Weapon\Weapon;
use AardsGerds\Game\Shared\IntegerValueException;

final class Player extends Entity
{
    public function __construct(
        string $name,
        Health $health,
        Etherum $etherum,
        Strength $strength,
        Initiative $initiative,
        TalentCollection $talentCollection,
        Inventory $inventory,
        ?Weapon $weapon,
        ?Corruption $corruption,
        private LevelProgress $levelProgress,
        private Health $maximumHealth,
        private AttributePoints $attributePoints,
        private TalentPoints $talentPoints,
        private VisitEvent $checkpoint,
    ) {
        parent::__construct(
            $name,
            $health,
            $etherum,
            $strength,
            $initiative,
            $talentCollection,
            $inventory,
            $weapon,
            $corruption,
        );
    }

    public static function new(string $name): self
    {
        return new self(
            $name,
            new Health(100),
            new Etherum(1),
            new Strength(5),
            new Initiative(10),
            new TalentCollection([
                WeaponMastery::shortSword(WeaponMasteryLevel::novice()),
                new Slash(),
            ]),
            new Inventory([new HealthPotion(), new HealthPotion()]),
            new RustyShortSword(),
            null,
            new LevelProgress(
                new Level(1),
                new Experience(0),
            ),
            new Health(100),
            new AttributePoints(0),
            new TalentPoints(0),
            new MercenaryCampVisitEvent(),
        );
    }

    public function getLevelProgress(): LevelProgress
    {
        return $this->levelProgress;
    }

    public function increaseExperience(Experience $experience, PlayerAction $playerAction): void
    {
        $this->levelProgress->increase($experience, $this, $playerAction);
    }

    public function getMaximumHealth(): Health
    {
        return $this->maximumHealth;
    }

    public function getAttributePoints(): AttributePoints
    {
        return $this->attributePoints;
    }

    public function getTalentPoints(): TalentPoints
    {
        return $this->talentPoints;
    }

    public function getCheckpoint(): VisitEvent
    {
        return $this->checkpoint;
    }

    public function setCheckpoint(VisitEvent $checkpoint): void
    {
        $this->checkpoint = $checkpoint;
    }

    public function heal(Health $health): void
    {
        $this->health->increaseBy($health);

        if ($this->health->isGreaterThan($this->maximumHealth)) {
            $this->healCompletely();
        }
    }

    public function healCompletely(): void
    {
        $this->health->replaceWith($this->maximumHealth);
    }

    /**
     * @throws PlayerException
     */
    public function increaseEtherum(Etherum $etherum): void
    {
        $this->etherum->increaseBy($etherum);

        $playerAscension = $this->talentCollection->findSecretKnowledge()?->getAscension()
            ?? throw PlayerException::etherumOverdose();

        $corruptionBoundary = $this->calculateCorruptionBoundary();

        if ($this->etherum->isGreaterThanOrEqual($corruptionBoundary)) {
            if ($this->corruption !== null) {
                try {
                    $this->corruption->increment();
                } catch (IntegerValueException) {}
            }

            if ($playerAscension->isLowerThan(Ascension::sixthAscension())) {
                throw PlayerException::etherumOverdose();
            }

            $this->corruption = Corruption::low();
        }
    }
}
