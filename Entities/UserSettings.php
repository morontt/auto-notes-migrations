<?php

/**
 * User: morontt
 * Date: 01.03.2025
 * Time: 13:25
 */

namespace AutoNotes\Entities;

use AutoNotes\Entities\Traits\TimeTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table]
class UserSettings
{
    use TimeTrait;

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\OneToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private $user;

    #[ORM\ManyToOne(targetEntity: Car::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'RESTRICT')]
    private $defaultCar;

    #[ORM\ManyToOne(targetEntity: Currency::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'RESTRICT')]
    private $defaultCurrency;
}
