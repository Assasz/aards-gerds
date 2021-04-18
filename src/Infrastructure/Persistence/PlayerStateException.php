<?php

declare(strict_types=1);

namespace AardsGerds\Game\Infrastructure\Persistence;

final class PlayerStateException extends \RuntimeException
{
    public static function notFound(string $fileName): self
    {
        return new self("Player state not found in file {$fileName}");
    }
}
