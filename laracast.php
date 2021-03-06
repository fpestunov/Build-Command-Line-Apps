#! /usr/bin/env php

<?php

use Acme\SayHelloCommand;
use Symfony\Component\Console\Application;

require 'vendor/autoload.php';

$app = new Application('Laracast Demo', 'version 1.0');

$app->add(new SayHelloCommand);

$app->run();

/*

php laracast.php sayHelloT Jane
php laracast.php sayHelloT Jane --greeting="Hi"
php laracast.php sayHelloT Jane --greeting "Good day"

*/
