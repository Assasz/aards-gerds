<?php

declare(strict_types=1);

namespace AardsGerds\Game\Player;

final class PlayerException extends \DomainException
{
    public static function etherumOverdose(): self
    {
        return new self('Player just died from etherum overdose');
    }
}
