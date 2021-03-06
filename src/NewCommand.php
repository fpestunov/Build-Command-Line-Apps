<?php
namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use GuzzleHttp\ClientInterface;
use ZipArchive;

class NewCommand extends Command
{
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;

        parent::__construct(); // without it will be error
                                // injection for -- ClientInterface $client
                                // $app->add(new NewCommand(new GuzzleHttp\Client));
    }

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
        $directory = getcwd() . '/' . $input->getArgument('name');

        $output->writeln('<info>Crafting application...</info>');
        
        $this->assertApplicationDoesNotExist($directory, $output);
            // Dont forget about '$this'

        // download nightly version of Laravel
        $this->download($zipFile = $this->makeFileName())
        // extract zip file
            ->extract($zipFile, $directory)
        // extract zip file
            ->cleanUp($zipFile);

        // alert the user that they are ready to go
        $output->writeln('<comment>Application ready!</comment>');
    }

    private function assertApplicationDoesNotExist($directory, OutputInterface $output)
    {
        if (is_dir($directory))
        {
            $output->writeln('<error>Application already exist</error>');
            exit(1); // Something going wrong...
        }
    }
    private function makeFileName()
    {
        return getcwd() . '/laravel_' . md5(time().uniqid()) . '.zip';
    }

    private function download($zipFile)
    {
        // install before
        // composer require guzzlehttp/guzzle
        $response = $this->client->get('http://cabinet.laravel.com/latest.zip')->getBody();

        file_put_contents($zipFile, $response);

        return $this; // in order to continue chain
    }

    private function extract($zipFile, $directory)
    {
        $archive = new ZipArchive;

        $archive->open($zipFile);
        $archive->extractTo($directory);
        $archive->close();

        return $this; // in order to continue chain
    }

    private function cleanUp($zipFile)
    {
        @chmod($zipFile, 0777); // why use @ ???
        @unlink($zipFile);

        return $this; // in order to continue chain
    }
}
