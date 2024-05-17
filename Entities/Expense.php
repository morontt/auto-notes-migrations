<?php

namespace AutoNotes\Entities;

use AutoNotes\Entities\Traits\CostTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table]
class Expense
{
    use CostTrait;

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    /**
     * @var int
     */
    #[ORM\Column(type: 'smallint', nullable: false)]
    private $type;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', nullable: false)]
    private $description;

    /**
     * @var DateTime
     */
    #[ORM\Column(type: 'date', nullable: false)]
    private $date;

    /**
     * @var User
     */
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    private $user;

    /**
     * @var DateTime
     */
    #[ORM\Column(type: 'datetime', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): Expense
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Expense
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): Expense
    {
        $this->date = $date;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): Expense
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}
