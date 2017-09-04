<?php

namespace App\Command;

use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Command\ContainerAwareCommand;

class ExampleCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('example:process')
            ->addArgument('type', InputArgument::REQUIRED, 'The type of items to process')
            ->addOption('no-cleanup', null, InputOption::VALUE_NONE)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $db = $this->getContainer()->get('app.service.example');
        $style = new OutputFormatterStyle('white', 'green', array('bold'));
        $output->getFormatter()->setStyle('mystyle', $style);
        $output->writeln('<mystyle>I am going to work on ' . $db->getValue() . '</mystyle>');
    }
}