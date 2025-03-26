<?php

namespace AutoNotes\Commands;

use AutoNotes\Commands\Traits\PasswordTrait;
use AutoNotes\Entities\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:user-create')]
class UserCreate extends Command
{
    use PasswordTrait;

    private EntityManager $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Creates a new user.')
            ->setHelp('This command allows you to create a user...')
            ->addArgument('username', InputArgument::REQUIRED, 'User name')
            ->addArgument('password', InputArgument::REQUIRED, 'User password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');

        $user = new User();
        $user
            ->setUsername($username)
            ->setPassword($this->passwordHasher()->hash($password, $user->getPasswordSalt()))
        ;

        $this->em->persist($user);
        $this->em->flush();

        $output->writeln('');
        $output->writeln(sprintf('<info>Create user: <comment>%s</comment></info>', $username));
        $output->writeln('');

        return Command::SUCCESS;
    }
}
