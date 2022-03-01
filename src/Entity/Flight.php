<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Flight
 *
 * @ORM\Table(name="flight")
 * @ORM\Entity
 */
class Flight implements \JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="icao24", type="string", length=10, nullable=false)
     */
    private $icao24;

    /**
     * @var int
     *
     * @ORM\Column(name="first_seen", type="bigint", nullable=false)
     */
    private $firstSeen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="est_departure_airport", type="string", length=10, nullable=true)
     */
    private $estDepartureAirport;

    /**
     * @var int
     *
     * @ORM\Column(name="last_seen", type="bigint", nullable=false)
     */
    private $lastSeen;

    /**
     * @var string
     *
     * @ORM\Column(name="est_arrival_airport", type="string", length=10, nullable=false)
     */
    private $estArrivalAirport;

    /**
     * @var string
     *
     * @ORM\Column(name="callsign", type="string", length=10, nullable=false)
     */
    private $callsign;

    /**
     * @var int|null
     *
     * @ORM\Column(name="est_departure_airport_horiz_distance", type="integer", nullable=true)
     */
    private $estDepartureAirportHorizDistance;

    /**
     * @var int|null
     *
     * @ORM\Column(name="est_departure_airport_vert_distance", type="integer", nullable=true)
     */
    private $estDepartureAirportVertDistance;

    /**
     * @var int|null
     *
     * @ORM\Column(name="est_arrival_airport_horiz_distance", type="integer", nullable=true)
     */
    private $estArrivalAirportHorizDistance;

    /**
     * @var int|null
     *
     * @ORM\Column(name="est_arrival_airport_vert_distance", type="integer", nullable=true)
     */
    private $estArrivalAirportVertDistance;

    /**
     * @var int|null
     *
     * @ORM\Column(name="departure_airport_candidates_count", type="integer", nullable=true)
     */
    private $departureAirportCandidatesCount;

    /**
     * @var int|null
     *
     * @ORM\Column(name="arrival_airport_candidates_count", type="integer", nullable=true)
     */
    private $arrivalAirportCandidatesCount;

    
  
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

    public function getFirstSeen(): ?string
    {
        return $this->firstSeen;
    }

    public function setFirstSeen(string $firstSeen): self
    {
        $this->firstSeen = $firstSeen;

        return $this;
    }

    public function getEstDepartureAirport(): ?string
    {
        return $this->estDepartureAirport;
    }

    public function setEstDepartureAirport(?string $estDepartureAirport): self
    {
        $this->estDepartureAirport = $estDepartureAirport;

        return $this;
    }

    public function getLastSeen(): ?string
    {
        return $this->lastSeen;
    }

    public function setLastSeen(string $lastSeen): self
    {
        $this->lastSeen = $lastSeen;

        return $this;
    }

    public function getEstArrivalAirport(): ?string
    {
        return $this->estArrivalAirport;
    }

    public function setEstArrivalAirport(string $estArrivalAirport): self
    {
        $this->estArrivalAirport = $estArrivalAirport;

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

    public function getEstDepartureAirportHorizDistance(): ?int
    {
        return $this->estDepartureAirportHorizDistance;
    }

    public function setEstDepartureAirportHorizDistance(?int $estDepartureAirportHorizDistance): self
    {
        $this->estDepartureAirportHorizDistance = $estDepartureAirportHorizDistance;

        return $this;
    }

    public function getEstDepartureAirportVertDistance(): ?int
    {
        return $this->estDepartureAirportVertDistance;
    }

    public function setEstDepartureAirportVertDistance(?int $estDepartureAirportVertDistance): self
    {
        $this->estDepartureAirportVertDistance = $estDepartureAirportVertDistance;

        return $this;
    }

    public function getEstArrivalAirportHorizDistance(): ?int
    {
        return $this->estArrivalAirportHorizDistance;
    }

    public function setEstArrivalAirportHorizDistance(?int $estArrivalAirportHorizDistance): self
    {
        $this->estArrivalAirportHorizDistance = $estArrivalAirportHorizDistance;

        return $this;
    }

    public function getEstArrivalAirportVertDistance(): ?int
    {
        return $this->estArrivalAirportVertDistance;
    }

    public function setEstArrivalAirportVertDistance(?int $estArrivalAirportVertDistance): self
    {
        $this->estArrivalAirportVertDistance = $estArrivalAirportVertDistance;

        return $this;
    }

    public function getDepartureAirportCandidatesCount(): ?int
    {
        return $this->departureAirportCandidatesCount;
    }

    public function setDepartureAirportCandidatesCount(?int $departureAirportCandidatesCount): self
    {
        $this->departureAirportCandidatesCount = $departureAirportCandidatesCount;

        return $this;
    }

    public function getArrivalAirportCandidatesCount(): ?int
    {
        return $this->arrivalAirportCandidatesCount;
    }

    public function setArrivalAirportCandidatesCount(?int $arrivalAirportCandidatesCount): self
    {
        $this->arrivalAirportCandidatesCount = $arrivalAirportCandidatesCount;

        return $this;
    }
    
    /**
     * Al ser serializable, nos obliga a reescribir el método jsonSerializable
     * @access public    
     */
   public function jsonSerialize(): array
   {
       return [            
           'icao24' => $this->icao24,
           'firstSeen' => $this->firstSeen,
           'estDepartureAirport' => $this->estDepartureAirport,
           'lastSeen' => $this->lastSeen,
           'estArrivalAirport' => $this->estArrivalAirport,
           'callsign' => $this->callsign,
           'estDepartureAirportHorizDistance' => $this->estDepartureAirportHorizDistance,
           'estDepartureAirportVertDistance' => $this->estDepartureAirportVertDistance,
           'estArrivalAirportHorizDistance' => $this->estArrivalAirportHorizDistance,
           'estArrivalAirportVertDistance' => $this->estArrivalAirportVertDistance,
           'departureAirportCandidatesCount' => $this->departureAirportCandidatesCount,
           'arrivalAirportCandidatesCount' => $this->arrivalAirportCandidatesCount                     
       ];
   }

}
