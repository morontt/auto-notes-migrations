<?php

namespace AutoNotes\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(type: 'string', length: 32, unique: true)]
    private $username;

    #[ORM\Column(type: 'string', length: 96)]
    private $password;

    #[ORM\Column(type: 'string', length: 32)]
    private $passwordSalt;

    #[ORM\Column(type: 'datetime', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private $createdAt;
}
