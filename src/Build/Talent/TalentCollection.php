<?php

declare(strict_types=1);

namespace AardsGerds\Game\Build\Talent;

use AardsGerds\Game\Build\Talent\WeaponMastery\WeaponMastery;
use AardsGerds\Game\Inventory\Weapon\WeaponType;
use AardsGerds\Game\Shared\Collection;

final class TalentCollection extends Collection
{
    public function findWeaponMasteryForWeaponType(WeaponType $weaponType): ?WeaponMastery
    {
        $weaponMasteryTalents = $this->filter(
            static fn(Talent $talent): bool =>
                $talent instanceof WeaponMastery && $talent->getType()->equals($weaponType),
        );

        return $weaponMasteryTalents->count() ? $weaponMasteryTalents->getIterator()->current() : null;
    }

    protected function getType(): string
    {
        return Talent::class;
    }
}
