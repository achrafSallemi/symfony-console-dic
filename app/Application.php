<?php

namespace App;

use Symfony\Component\Console\Application as SymfonyConsoleApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\Container;
use App\Commands;

class Application extends SymfonyConsoleApplication
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @var Commands
     */
    private $commands;

    /**
     * Class constructor
     *
     * @param string $name
     * @param string $version
     * @param Container $container
     * @param Commands $commands
     */
    public function __construct(
        $name = 'UNKNOWN',
        $version = 'UNKNOWN',
        Container $container,
        Commands $commands
    ) {
        parent::__construct($name, $version);

        $this->container = $container;
        $this->commands = $commands;
    }

    /**
     * @inheritdoc
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $this->addCommands($this->commands->getAvailableCommands());
        $this->injectContainer();

        parent::doRun($input, $output);
    }

    /**
     * Inject Container to commands
     */
    private function injectContainer()
    {
        foreach ($this->all() as $command) {
            if ($command instanceof ContainerAwareInterface) {
                $command->setContainer($this->container);
            }
        }
    }
}
