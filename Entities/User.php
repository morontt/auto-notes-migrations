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

    #[ORM\Column(type: 'string', length: 64)]
    private $password;

    #[ORM\Column(type: 'string', length: 32)]
    private $passwordSalt;

    #[ORM\Column(type: 'datetime', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private $createdAt;

    public function __construct()
    {
        $this->passwordSalt = base64_encode(random_bytes(24));
        $this->createdAt = new \DateTime();
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPasswordSalt(): string
    {
        return $this->passwordSalt;
    }

    public function setPasswordSalt(string $salt): self
    {
        $this->passwordSalt = $salt;

        return $this;
    }
}
