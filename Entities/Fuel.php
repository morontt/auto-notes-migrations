<?php

namespace AutoNotes\Entities;

use AutoNotes\Entities\Traits\CostTrait;
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

    #[ORM\ManyToOne(targetEntity: FillingStation::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    private $station;

    #[ORM\ManyToOne(targetEntity: Car::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'RESTRICT')]
    private $car;

    #[ORM\Column(type: 'date', nullable: false)]
    private $date;

    #[ORM\ManyToOne(targetEntity: Mileage::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private $mileage;

    #[ORM\Column(type: 'datetime', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private $createdAt;
}
