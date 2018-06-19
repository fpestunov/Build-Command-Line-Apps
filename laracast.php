#! /usr/bin/env php

<?php

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

require 'vendor/autoload.php';

$app = new Application();

$app->register('sayHelloTo')
    ->addArgument('name')
    ->setCode(function(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hello World');
    });

$app->run();
