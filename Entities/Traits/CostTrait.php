<?php

namespace AutoNotes\Entities\Traits;

use AutoNotes\Entities\Currency;
use Doctrine\ORM\Mapping as ORM;

trait CostTrait
{
    #[ORM\Column(type: 'decimal', precision: 8, scale: 2)]
    private $cost;

    #[ORM\ManyToOne(targetEntity: Currency::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    private $currency;
}
