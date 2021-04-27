<?php

declare(strict_types=1);

namespace AardsGerds\Game\Entity\Human;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Attribute\Health;
use AardsGerds\Game\Build\Attribute\Initiative;
use AardsGerds\Game\Build\Attribute\Strength;
use AardsGerds\Game\Build\Talent\SecretKnowledge\Ascension;
use AardsGerds\Game\Build\Talent\SecretKnowledge\EighthAscension\ProtectionOfTheGods;
use AardsGerds\Game\Build\Talent\SecretKnowledge\SecretKnowledge;
use AardsGerds\Game\Build\Talent\TalentCollection;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMasteryLevel;
use AardsGerds\Game\Entity\Entity;
use AardsGerds\Game\Inventory\Inventory;
use AardsGerds\Game\Inventory\Weapon\GreatSword\Protector;
use AardsGerds\Game\Location\Town\Visitor;
use AardsGerds\Game\Location\Town\VisitorRole;

final class Mefadriel extends Entity implements Visitor
{
    public function __construct(
        private VisitorRole $visitorRole,
    ) {
        parent::__construct(
            'Mefadriel',
            new Health(10000),
            new Etherum(200),
            new Strength(200),
            new Initiative(100),
            new TalentCollection([
                WeaponMastery::greatSword(WeaponMasteryLevel::masterOfThirdTier()),
                new SecretKnowledge(Ascension::eighthAscension()),
                new ProtectionOfTheGods(),
            ]),
            new Inventory([]),
            new Protector(new Etherum(200)),
            true,
        );
    }

    public function getRole(): VisitorRole
    {
        return $this->visitorRole;
    }
}
