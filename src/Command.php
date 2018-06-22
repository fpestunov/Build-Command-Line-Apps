<?php
namespace Acme;

use Symfony\Component\Console\Command\Command as SymfonyCommand;

class Command extends SymfonyCommand
{
    // protected instead private
    // for using in AddComand
    protected $database;

    public function __construct(DatabaseAdapter $database)
    {
        $this->database = $database;

        parent::__construct();
    }
}
