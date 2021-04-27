<?php

declare(strict_types=1);

namespace AardsGerds\Game\Infrastructure;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class GameKernel
{
    public const ENV_PROD = 'prod';
    public const ENV_TEST = 'test';

    private ContainerBuilder $container;
    private Application $console;

    public function __construct(
        private string $environment,
    ) {
        $this->setUpContainer();
        $this->setUpConsole();
    }

    public function runConsole(): void
    {
        $this->console->run();
    }

    public function getContainer(): ContainerBuilder
    {
        return $this->container;
    }

    private function setUpContainer(): void
    {
        $this->container = new ContainerBuilder();
        $projectDir = dirname(__DIR__, 2);
        $loader = new YamlFileLoader($this->container, new FileLocator("{$projectDir}/config"));

        $loader->load(match ($this->environment) {
            self::ENV_PROD => 'services.yaml',
            self::ENV_TEST => 'services_test.yaml',
            default => throw GameKernelException::unknownEnvironment($this->environment),
        });

        $this->container->setParameter('kernel.project_dir', $projectDir);
        $this->container->compile();
    }

    private function setUpConsole(): void
    {
        $this->console = new Application();
        $commands = $this->container->findTaggedServiceIds('console.command');

        foreach ($commands as $commandId => $tags) {
            /** @var Command $command */
            $command = $this->container->get($commandId);
            $this->console->add($command);
        }
    }
}
