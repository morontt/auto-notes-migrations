<?php

namespace AutoNotes\Entities\Traits;

use AutoNotes\Entities\Currency;
use Doctrine\ORM\Mapping as ORM;

trait CostTrait
{
    /**
     * @var float
     */
    #[ORM\Column(type: 'decimal', precision: 8, scale: 2)]
    private $cost;

    /**
     * @var Currency
     */
    #[ORM\ManyToOne(targetEntity: Currency::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'RESTRICT')]
    private $currency;

    public function getCost(): float
    {
        return $this->cost;
    }

    public function setCost(float $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function setCurrency(Currency $currency): self
    {
        $this->currency = $currency;

        return $this;
    }
}
