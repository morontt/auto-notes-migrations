<?php

namespace AutoNotes\Entities\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait TimeTrait
{
    #[ORM\Column(type: 'datetime', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true, columnDefinition: 'DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP')]
    private $updatedAt;

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
