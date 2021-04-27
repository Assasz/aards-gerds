<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Integration;

use AardsGerds\Game\Infrastructure\GameKernel;
use PHPUnit\Framework\TestCase;

abstract class IntegrationTestCase extends TestCase
{
    protected static ?GameKernel $gameKernel;

    public function setUp(): void
    {
        self::$gameKernel = new GameKernel(GameKernel::ENV_TEST);
    }

    public function tearDown(): void
    {
        self::$gameKernel = null;
    }

    protected static function getService(string $className): object
    {
        return self::$gameKernel->getContainer()->get($className);
    }

    protected static function getParameter(string $parameter): mixed
    {
        return self::$gameKernel->getContainer()->getParameter($parameter);
    }
}
