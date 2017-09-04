<?php

namespace App;

use App\Exception\CommandDoesNotExist;
use App\Exception\CommandsFileWrongStructure;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Yaml\Yaml;

class Commands
{
    /**
     * @var array
     */
    private $commands;

    public function __construct($yamlFile)
    {
        $commands = Yaml::parse(file_get_contents($yamlFile));

        if(!isset($commands['commands'])) {
            throw new CommandsFileWrongStructure('Yaml commands file structure is wrong');
        }

        foreach ($commands['commands'] as $command) {
            if (!class_exists($command)) {
                throw new CommandDoesNotExist(sprintf('The command %s does not exist', $command));
            }

            $this->commands[] = new $command;
        }
    }

    /**
     * Returns the list of available commands
     * @return array
     */
    public function getAvailableCommands()
    {
        return $this->commands;
    }
}
