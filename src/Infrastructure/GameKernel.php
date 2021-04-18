<?php

declare(strict_types=1);

namespace AardsGerds\Game\Infrastructure;

use AardsGerds\Game\Infrastructure\Cli\RunGameCommand;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class GameKernel
{
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
        $loader = new YamlFileLoader(
            $this->container,
            new FileLocator(dirname(__DIR__, 2) . '/config'),
        );

        $loader->load(match ($this->environment) {
            'test' => 'services_test.yaml',
            'prod' => 'services.yaml',
            default => throw GameKernelException::unknownEnvironment($this->environment),
        });

        $this->container->setParameter('kernel.project_dir', dirname(__DIR__, 2));
        $this->container->compile();
    }

    private function setUpConsole(): void
    {
        $this->console = new Application();
        $this->console->add(new RunGameCommand());
    }
}
