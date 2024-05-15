<?php

namespace AutoNotes\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table]
class Car
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(type: 'string', nullable: true)]
    protected $brandName;

    #[ORM\Column(type: 'string', nullable: true)]
    protected $modelName;

    #[ORM\Column(name: 'prod_year', type: 'integer', nullable: true)]
    protected $yearOfProduction;

    #[ORM\Column(type: 'string', length: 17, nullable: true)]
    protected $vin;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    protected $user;

    #[ORM\Column(type: 'datetime', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private $createdAt;
}
