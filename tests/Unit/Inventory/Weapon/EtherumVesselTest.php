<?php

declare(strict_types=1);

namespace AardsGerds\Game\Tests\Unit\Inventory\Weapon;

use AardsGerds\Game\Build\Attribute\Etherum;
use AardsGerds\Game\Build\Talent\SecretKnowledge\Ascension;
use AardsGerds\Game\Inventory\Weapon\EtherumVessel;
use PHPUnit\Framework\TestCase;

final class EtherumVesselTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideEtherumVessels
     * @param EtherumVessel|object $etherumVessel
     */
    public function calculatesRequiredAscension(
        object $etherumVessel,
        Ascension $expectedRequiredAscension,
    ): void {
        self::assertTrue($etherumVessel->getRequiredAscension()->equals($expectedRequiredAscension));
    }

    public function provideEtherumVessels(): \Generator
    {
        yield '0 etherum load' => [
            $this->createEtherumVessel(new Etherum(0)),
            Ascension::firstAscension(),
        ];

        yield '10 etherum load' => [
            $this->createEtherumVessel(new Etherum(10)),
            Ascension::fourthAscension(),
        ];

        yield '100 etherum load' => [
            $this->createEtherumVessel(new Etherum(100)),
            Ascension::seventhAscension(),
        ];

        yield '200 etherum load' => [
            $this->createEtherumVessel(new Etherum(200)),
            Ascension::eighthAscension(),
        ];
    }

    private function createEtherumVessel(Etherum $etherumLoad): object
    {
        return new class ($etherumLoad) {
            use EtherumVessel;

            public function __construct(
                private Etherum $etherumLoad,
            ) {}
        };
    }
}
