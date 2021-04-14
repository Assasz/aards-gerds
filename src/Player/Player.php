<?php

declare(strict_types=1);

namespace AardsGerds\Game\Player;

use AardsGerds\Game\Build\Attribute\AttributePoints;
use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Experience;
use AardsGerds\Game\Build\Level;
use AardsGerds\Game\Build\LevelProgress;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Build\Talent\TalentPoints;
use AardsGerds\Game\Entity\Human\Human;
use AardsGerds\Game\Inventory\Weapon\ShortSword\RustyShortSword;
use AardsGerds\Game\Inventory\Weapon\Weapon;

final class Player extends Human
{
    public function __construct(
        string $name,
        Health $health,
        Etherum $etherum,
        Strength $strength,
        TalentCollection $talentCollection,
        ?Weapon $weapon,
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
            $weapon,
        );
    }

    public static function denormalize(array $data): self
    {
        return new self(
            $data['name'],
            new Health($data['health']),
            new Etherum($data['etherum']),
            new Strength($data['strength']),
            new TalentCollection([]),
            new RustyShortSword(),
            new LevelProgress(
                new Level($data['levelProgress']['level']),
                new Experience($data['levelProgress']['currentExperience']),
            ),
            new AttributePoints($data['attributePoints']),
            new TalentPoints($data['talentPoints']),
        );
    }

    public function normalize(): array
    {
        return [
            'name' => $this->name,
            'health' => $this->health->get(),
            'etherum' => $this->etherum->get(),
            'strength' => $this->strength->get(),
            'talents' => 'not implemented yet',
            'weapon' => 'not implemented yet',
            'levelProgress' => [
                'level' => $this->levelProgress->getLevel()->get(),
                'currentExperience' => $this->levelProgress->getCurrentExperience()->get(),
            ],
            'attributePoints' => $this->attributePoints->get(),
            'talentPoints' => $this->talentPoints->get(),
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
