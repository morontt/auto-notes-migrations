<?php

namespace AutoNotes\Entities;

use AutoNotes\Entities\Traits\CostTrait;
use AutoNotes\Entities\Traits\TimeTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table]
class Order
{
    use CostTrait;
    use TimeTrait;

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', nullable: false)]
    private $description;

    /**
     * @var string|null
     */
    #[ORM\Column(type: 'string', nullable: true)]
    private $capacity;

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
     * @var DateTime|null
     */
    #[ORM\Column(type: 'date', nullable: true)]
    private $usedAt;

    /**
     * @var Mileage|null
     */
    #[ORM\ManyToOne(targetEntity: Mileage::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private $mileage;

    /**
     * @var OrderType|null
     */
    #[ORM\ManyToOne(targetEntity: OrderType::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'RESTRICT')]
    private $type;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function getId()
    {
        return $this->id;
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

    public function getCapacity(): ?string
    {
        return $this->capacity;
    }

    public function setCapacity(?string $capacity): self
    {
        $this->capacity = $capacity;

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

    public function getUsedAt(): ?DateTime
    {
        return $this->usedAt;
    }

    public function setUsedAt(?DateTime $usedAt): self
    {
        $this->usedAt = $usedAt;

        return $this;
    }

    public function getMileage(): ?Mileage
    {
        return $this->mileage;
    }

    public function setMileage(?Mileage $mileage): self
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getType(): ?OrderType
    {
        return $this->type;
    }

    public function setType(?OrderType $type): self
    {
        $this->type = $type;

        return $this;
    }
}
