<?php

namespace AutoNotes\Entities;

use AutoNotes\Entities\Traits\CostTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table]
class Fuel
{
    use CostTrait;

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    /**
     * @var FillingStation
     */
    #[ORM\ManyToOne(targetEntity: FillingStation::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    private $station;

    /**
     * @var float
     */
    #[ORM\Column(type: 'decimal', precision: 8, scale: 2)]
    private $value;

    /**
     * @var Car|null
     */
    #[ORM\ManyToOne(targetEntity: Car::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'RESTRICT')]
    private $car;

    /**
     * @var DateTime
     */
    #[ORM\Column(type: 'date', nullable: false)]
    private $date;

    /**
     * @var Mileage
     */
    #[ORM\ManyToOne(targetEntity: Mileage::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private $mileage;

    /**
     * @var FuelType
     */
    #[ORM\ManyToOne(targetEntity: FuelType::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    private $type;

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

    public function getStation(): FillingStation
    {
        return $this->station;
    }

    public function setStation(FillingStation $station): self
    {
        $this->station = $station;

        return $this;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): self
    {
        $this->car = $car;

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

    public function getMileage(): ?Mileage
    {
        return $this->mileage;
    }

    public function setMileage(?Mileage $mileage): self
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getType(): FuelType
    {
        return $this->type;
    }

    public function setType(FuelType $type): self
    {
        $this->type = $type;

        return $this;
    }
}
