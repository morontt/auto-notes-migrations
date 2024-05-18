<?php

namespace AutoNotes\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table]
class Service
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    /**
     * @var float
     */
    #[ORM\Column(type: 'decimal', precision: 8, scale: 2, nullable: true)]
    private $cost;

    /**
     * @var Currency
     */
    #[ORM\ManyToOne(targetEntity: Currency::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'RESTRICT')]
    private $currency;

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
     * @var Car
     */
    #[ORM\ManyToOne(targetEntity: Car::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    private $car;

    /**
     * @var Mileage
     */
    #[ORM\ManyToOne(targetEntity: Mileage::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private $mileage;

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

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(?float $cost): Service
    {
        $this->cost = $cost;

        return $this;
    }

    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    public function setCurrency(?Currency $currency): Service
    {
        $this->currency = $currency;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Service
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): Service
    {
        $this->date = $date;

        return $this;
    }

    public function getCar(): Car
    {
        return $this->car;
    }

    public function setCar(Car $car): Service
    {
        $this->car = $car;

        return $this;
    }

    public function getMileage(): ?Mileage
    {
        return $this->mileage;
    }

    public function setMileage(?Mileage $mileage): Service
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}
