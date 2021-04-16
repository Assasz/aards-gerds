<?php

declare(strict_types=1);

namespace AardsGerds\Game\Player;

use AardsGerds\Game\Build\Attribute\AttributePoints;
use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Experience;
use AardsGerds\Game\Build\LevelProgress;
use AardsGerds\Game\Build\Talent\SecretKnowledge\Ascension;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Build\Talent\TalentPoints;
use AardsGerds\Game\Entity\Entity;
use AardsGerds\Game\Inventory\Inventory;
use AardsGerds\Game\Inventory\Weapon\Weapon;

final class Player extends Entity
{
    public function __construct(
        string $name,
        Health $health,
        Etherum $etherum,
        Strength $strength,
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
            $talentCollection,
            $inventory,
            $weapon,
            $corrupted,
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

        if (!$this->isCorrupted() && $this->etherum->isGreaterThanOrEqual($corruptionBoundary)) {
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
}
