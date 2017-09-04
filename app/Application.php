<?php

namespace App;

use Symfony\Component\Console\Application as SymfonyConsoleApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\Container;
use App\Command\BatchProcessCommand;

class Application extends SymfonyConsoleApplication
{
    /**
     * @var Container
     */
    private $container;

    /**
     * Class constructor
     *
     * @param string $name
     * @param string $version
     * @param Container $container
     */
    public function __construct(
        $name = 'UNKNOWN',
        $version = 'UNKNOWN',
        Container $container = null
    ) {
        parent::__construct($name, $version);

        $this->container = $container;
    }

    /**
     * @inheritdoc
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $this->addCommands(static::getAvailableCommands());
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

    /**
     * Returns the list of available commands
     * @return array
     */
    public static function getAvailableCommands()
    {
        return [
            new BatchProcessCommand(),
        ];
    }
}
