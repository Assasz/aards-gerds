<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Unit\Inventory\Weapon;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Talent\SecretKnowledge\Ascension;
use AardsGerds\Game\Inventory\Weapon\RebredirWeapon;
use PHPUnit\Framework\TestCase;

final class RebredirWeaponTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideRebredirWeapons
     * @param RebredirWeapon|object $rebredirWeapon
     */
    public function calculatesRequiredAscension(
        object $rebredirWeapon,
        Ascension $expectedRequiredAscension,
    ): void {
        self::assertTrue($rebredirWeapon->getRequiredAscension()->equals($expectedRequiredAscension));
    }

    public function provideRebredirWeapons(): \Generator
    {
        yield '0 etherum load' => [
            $this->createRebredirWeapon(new Etherum(0)),
            Ascension::firstAscension(),
        ];

        yield '10 etherum load' => [
            $this->createRebredirWeapon(new Etherum(10)),
            Ascension::fourthAscension(),
        ];

        yield '100 etherum load' => [
            $this->createRebredirWeapon(new Etherum(100)),
            Ascension::seventhAscension(),
        ];

        yield '200 etherum load' => [
            $this->createRebredirWeapon(new Etherum(200)),
            Ascension::eighthAscension(),
        ];
    }

    private function createRebredirWeapon(Etherum $etherumLoad): object
    {
        return new class ($etherumLoad) {
            use RebredirWeapon;

            public function __construct(
                private Etherum $etherumLoad,
            ) {}
        };
    }
}
