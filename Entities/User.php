<?php

namespace AutoNotes\Entities;

use AutoNotes\Entities\Traits\TimeTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table]
class User
{
    use TimeTrait;

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(type: 'string', length: 32, unique: true)]
    private $username;

    #[ORM\Column(type: 'string', length: 60)]
    private $password;

    public function __construct()
    {
        $this->createdAt = new DateTime();
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
}
