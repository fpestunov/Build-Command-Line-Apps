<?php
namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class NewCommand extends Command
{
    public function configure()
    {
        $this->setName('new')
            ->setDescription('Create a new Laravel application.')
            ->addArgument('name', InputArgument::REQUIRED);
    }
    
    public function execute(InputInterface $input, OutputInterface $output)
    {
        // What we will do:
        // assert that the folder doesnt't already exist

        // download nightly version of Laravel

        // extract zip file

        // alert the user that they are ready to go
    }
}
