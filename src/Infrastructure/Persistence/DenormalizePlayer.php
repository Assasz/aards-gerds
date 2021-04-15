<?php

declare(strict_types=1);

namespace AardsGerds\Game\Infrastructure\Persistence;

use AardsGerds\Game\Build\Attribute\AttributePoints;
use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Experience;
use AardsGerds\Game\Build\Level;
use AardsGerds\Game\Build\LevelProgress;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Build\Talent\TalentPoints;
use AardsGerds\Game\Inventory\Inventory;
use AardsGerds\Game\Inventory\Weapon\ShortSword\RustyShortSword;
use AardsGerds\Game\Player\Player;

final class DenormalizePlayer
{
    public function __invoke(array $data): Player
    {
        return new Player(
            $data['name'],
            new Health($data['health']),
            new Etherum($data['etherum']),
            new Strength($data['strength']),
            new TalentCollection([]),
            new Inventory([]),
            new RustyShortSword(),
            new LevelProgress(
                new Level($data['levelProgress']['level']),
                new Experience($data['levelProgress']['currentExperience']),
            ),
            new AttributePoints($data['attributePoints']),
            new TalentPoints($data['talentPoints']),
        );
    }
}
