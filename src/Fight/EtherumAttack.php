<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

use AardsGerds\Game\Build\Attribute\Damage;
use AardsGerds\Game\Build\Attribute\Etherum;

interface EtherumAttack extends Attack
{
    public function getDamage(): Damage;

    public static function getEtherumCost(): Etherum;
}
