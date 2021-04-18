<?php

declare(strict_types=1);

namespace AardsGerds\Game\Infrastructure;

final class GameKernelException extends \RuntimeException
{
    public static function unknownEnvironment(string $environment): self
    {
        return new self("Unknown environment: {$environment}");
    }
}
