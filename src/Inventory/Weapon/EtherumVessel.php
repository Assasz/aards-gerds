<?php

declare(strict_types=1);

namespace AardsGerds\Game\Inventory\Weapon;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Talent\SecretKnowledge\Ascension;

trait EtherumVessel
{
    private Etherum $etherumLoad;

    public function getEtherumLoad(): Etherum
    {
        return $this->etherumLoad;
    }

    public function getRequiredAscension(): Ascension
    {
        return $this->calculateRequiredAscension();
    }

    private function calculateRequiredAscension(): Ascension
    {
        foreach (range(Ascension::EIGHTH_ASCENSION, Ascension::FIRST_ASCENSION) as $ascension) {
            if ($this->etherumLoad->isGreaterThanOrEqual((new Ascension($ascension))->getRequiredEtherum())) {
                return new Ascension($ascension);
            }
        }

        return Ascension::firstAscension();
    }
}
