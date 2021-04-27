<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Weapon;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Talent\SecretKnowledge\Ascension;

interface RebredirWeapon
{
    public function getEtherumLoad(): Etherum;

    public function getRequiredAscension(): Ascension;
}
