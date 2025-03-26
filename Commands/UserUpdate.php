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

#[AsCommand(name: 'app:user-update')]
class UserUpdate extends Command
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
            ->setDescription('Update the user.')
            ->setHelp('Update user password by username')
            ->addArgument('username', InputArgument::REQUIRED, 'User name')
            ->addArgument('password', InputArgument::REQUIRED, 'User password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');

        $output->writeln('');

        $user = $this->em->getRepository(User::class)->findOneBy(['username' => $username]);
        if (!$user) {
            $output->writeln(sprintf('<error>Error: user "%s" not found</error>', $username));
        } else {
            $user->setPassword($this->passwordHasher()->hash($password));
            $this->em->flush();

            $output->writeln(sprintf('<info>Update user: <comment>%s</comment></info>', $username));
        }
        $output->writeln('');

        return Command::SUCCESS;
    }
}
