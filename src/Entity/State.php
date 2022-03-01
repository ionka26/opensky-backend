<?php

namespace App\Entity;

use App\Repository\StateRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=StateRepository::class)
 */
class State implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $icao24;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $callsign;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $origin_country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $longitud;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $latitud;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIcao24(): ?string
    {
        return $this->icao24;
    }

    public function setIcao24(string $icao24): self
    {
        $this->icao24 = $icao24;

        return $this;
    }

    public function getCallsign(): ?string
    {
        return $this->callsign;
    }

    public function setCallsign(string $callsign): self
    {
        $this->callsign = $callsign;

        return $this;
    }

    public function getOriginCountry(): ?string
    {
        return $this->origin_country;
    }

    public function setOriginCountry(string $origin_country): self
    {
        $this->origin_country = $origin_country;

        return $this;
    }

    public function getLongitud(): ?string
    {
        return $this->longitud;
    }

    public function setLongitud(string $longitud): self
    {
        $this->longitud = $longitud;

        return $this;
    }

    public function getLatitud(): ?string
    {
        return $this->latitud;
    }

    public function setLatitud(string $latitud): self
    {
        $this->latitud = $latitud;

        return $this;
    }
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'icao24' => $this->icao24,
            'callsign' => $this->callsign,
            'origin_country' => $this->origin_country,
            'longitud' => $this->longitud,
            'latitud' => $this->latitud             
        ];
    }
}
