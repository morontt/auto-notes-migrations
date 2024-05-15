<?php

namespace AutoNotes\Entities;

use AutoNotes\Entities\Traits\CostTrait;
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

    #[ORM\Column(type: 'smallint', nullable: false)]
    private $type;

    #[ORM\Column(type: 'string', nullable: false)]
    private $description;

    #[ORM\Column(type: 'date', nullable: false)]
    private $date;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    private $user;

    #[ORM\Column(type: 'datetime', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private $createdAt;
}
