<?php

namespace AutoNotes\Entities;

use AutoNotes\Entities\Traits\TimeTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table]
class Car
{
    use TimeTrait;

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(type: 'string', nullable: true)]
    private $brandName;

    #[ORM\Column(type: 'string', nullable: true)]
    private $modelName;

    #[ORM\Column(name: 'prod_year', type: 'integer', nullable: true)]
    private $yearOfProduction;

    #[ORM\Column(type: 'string', length: 17, nullable: true)]
    private $vin;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    private $user;
}
