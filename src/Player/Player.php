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
use AardsGerds\Game\Entity\Entity;
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
        bool $corrupted,
        private LevelProgress $levelProgress,
        private AttributePoints $attributePoints,
        private TalentPoints $talentPoints,
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
            $corrupted,
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
            new TalentCollection([new Slash()]),
            new Inventory([]),
            new RustyShortSword(),
            false,
            new LevelProgress(
                new Level(1),
                new Experience(0),
            ),
            new AttributePoints(0),
            new TalentPoints(0),
        );
    }

    public function getLevelProgress(): LevelProgress
    {
        return $this->levelProgress;
    }

    public function increaseExperience(Experience $experience): void
    {
        $this->levelProgress->increase($experience, $this);
    }

    /**
     * @throws PlayerException
     */
    public function increaseEtherum(Etherum $etherum): void
    {
        $this->etherum->increaseBy($etherum);

        if ($this->isCorrupted()) {
            return;
        }

        $playerAscension = $this->talentCollection->findSecretKnowledge()?->getAscension()
            ?? throw PlayerException::etherumOverdose();

        $corruptionBoundary = $this->calculateCorruptionBoundary();

        if ($this->etherum->isGreaterThanOrEqual($corruptionBoundary)) {
            if ($playerAscension->isLowerThan(Ascension::sixthAscension())) {
                throw PlayerException::etherumOverdose();
            }

            $this->corrupted = true;
        }
    }

    public function getAttributePoints(): AttributePoints
    {
        return $this->attributePoints;
    }

    public function getTalentPoints(): TalentPoints
    {
        return $this->talentPoints;
    }

    private function calculateCorruptionBoundary(): Etherum
    {
        $ascension = $this->talentCollection->findSecretKnowledge()?->getAscension();
        if ($ascension === null) {
            return new Etherum(2);
        }

        try {
            $nextAscensionEtherum = $ascension->increment()->getRequiredEtherum();
        } catch (IntegerValueException $exception) {
            // entity has 8th ascension
            $nextAscensionEtherum = new Etherum($ascension->getRequiredEtherum()->get() * 2);
        }

        // etherum required by next ascension + 0.5 x etherum required by next ascension
        return $nextAscensionEtherum->increaseBy(
            new Etherum((int) ($nextAscensionEtherum->get() * 0.5)),
        );
    }
}
