<?php

namespace AutoNotes\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table]
#[ORM\UniqueConstraint(columns: ['date', 'distanse', 'car_id'])]
class Mileage
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    /**
     * @var DateTime
     */
    #[ORM\Column(type: 'date', nullable: false)]
    private $date;

    /**
     * @var int
     */
    #[ORM\Column(type: 'integer')]
    private $distanse;

    /**
     * @var Car
     */
    #[ORM\ManyToOne(targetEntity: Car::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    private $car;

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

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): Mileage
    {
        $this->date = $date;

        return $this;
    }

    public function getDistanse(): int
    {
        return $this->distanse;
    }

    public function setDistanse(int $distanse): Mileage
    {
        $this->distanse = $distanse;

        return $this;
    }

    public function getCar(): Car
    {
        return $this->car;
    }

    public function setCar(Car $car): Mileage
    {
        $this->car = $car;

        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}
