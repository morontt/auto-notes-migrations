<?php

namespace AutoNotes\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table]
class Fuel
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(type: 'decimal', precision: 8, scale: 2)]
    private $cost;

    #[ORM\ManyToOne(targetEntity: Currency::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    protected $currency;

    #[ORM\ManyToOne(targetEntity: FillingStation::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    protected $station;

    #[ORM\ManyToOne(targetEntity: Car::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'RESTRICT')]
    protected $car;

    #[ORM\Column(type: 'date', nullable: false)]
    protected $date;

    #[ORM\Column(type: 'datetime', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private $createdAt;
}
