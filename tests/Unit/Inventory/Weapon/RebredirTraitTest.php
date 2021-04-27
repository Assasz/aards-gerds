<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Unit\Inventory\Weapon;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Talent\SecretKnowledge\Ascension;
use AardsGerds\Game\Inventory\Weapon\RebredirTrait;
use PHPUnit\Framework\TestCase;

final class RebredirTraitTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideRebredirItems
     * @param RebredirTrait|object $rebredirItem
     */
    public function calculatesRequiredAscension(
        object $rebredirItem,
        Ascension $expectedRequiredAscension,
    ): void {
        self::assertTrue($rebredirItem->getRequiredAscension()->equals($expectedRequiredAscension));
    }

    public function provideRebredirItems(): \Generator
    {
        yield '0 etherum load' => [
            $this->createRebredirItem(new Etherum(0)),
            Ascension::firstAscension(),
        ];

        yield '10 etherum load' => [
            $this->createRebredirItem(new Etherum(10)),
            Ascension::fourthAscension(),
        ];

        yield '100 etherum load' => [
            $this->createRebredirItem(new Etherum(100)),
            Ascension::seventhAscension(),
        ];

        yield '200 etherum load' => [
            $this->createRebredirItem(new Etherum(200)),
            Ascension::eighthAscension(),
        ];
    }

    private function createRebredirItem(Etherum $etherumLoad): object
    {
        return new class ($etherumLoad) {
            use RebredirTrait;

            public function __construct(
                private Etherum $etherumLoad,
            ) {}
        };
    }
}
