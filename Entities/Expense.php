<?php

namespace AutoNotes\Entities;

use AutoNotes\Entities\Traits\CostTrait;
use AutoNotes\Entities\Traits\TimeTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table]
class Expense
{
    use CostTrait;
    use TimeTrait;

    public const TYPE_GARAGE = 1;
    public const TYPE_TOOLS = 2;
    public const TYPE_TAX = 3;
    public const TYPE_INSURANCE = 4;
    public const TYPE_ROAD = 5;
    public const TYPE_WASHING = 6;
    public const TYPE_PARKING = 7;
    public const TYPE_OTHER = 99;

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

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
