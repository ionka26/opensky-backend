<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=AirportRepository::class)
 */
class Airport implements \JsonSerializable
{
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

        public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Al ser serializable, nos obliga a reescribir el método jsonSerializable
     * @access public    
     */
    public function jsonSerialize(): array
    {
        return [            
            'name' => $this->name                       
        ];
    }
}
