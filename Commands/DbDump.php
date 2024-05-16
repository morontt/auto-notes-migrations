<?php

namespace AutoNotes\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:dump')]
class DbDump extends Command
{
    private array $dbConfig;

    public function __construct(array $dbConfig)
    {
        $this->dbConfig = $dbConfig;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('DB dump')
            ->setHelp('Create dump of database')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $dumpPath = $this->getFilename();
        $command = sprintf(
            'mysqldump -h %s -u %s --password=%s %s | gzip > %s 2>&1',
            $this->dbConfig['host'],
            $this->dbConfig['user'],
            escapeshellarg($this->dbConfig['password']),
            $this->dbConfig['dbname'],
            $dumpPath
        );

        exec($command);

        $output->writeln(
            sprintf(
                '<info>Database dump created: <comment>%s</comment>, %dKB</info>',
                pathinfo($dumpPath, PATHINFO_BASENAME),
                (int)(filesize($dumpPath) / 1024)
            )
        );

        return Command::SUCCESS;
    }

    private function getFilename(): string
    {
        return sprintf(
            '%s/dump_%s.sql.gz',
            realpath(__DIR__ . '/../dumps'),
            (new \DateTime())->format('YmdHi')
        );
    }
}
