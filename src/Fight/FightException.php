<?php

declare(strict_types=1);

namespace AardsGerds\Game\Fight;

final class FightException extends \DomainException
{
    public static function weaponRequired(): self
    {
        return new self('This attack requires weapon equipped');
    }
}
