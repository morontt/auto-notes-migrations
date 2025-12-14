<?php

namespace AutoNotes\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table]
class FuelType
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(type: 'string', length: 16, unique: true)]
    private $name;

    /**
     * @var FuelType|null
     */
    #[ORM\ManyToOne(targetEntity: FuelType::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'RESTRICT')]
    private $parent;

    #[ORM\Column(type: 'datetime', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParent(): ?FuelType
    {
        return $this->parent;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}
