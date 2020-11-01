<?php

namespace App\Entity;

use App\Repository\ShipmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShipmentRepository::class)
 */
class Shipment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="integer")
     */
    private $Shipmented;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getShipmented(): ?int
    {
        return $this->Shipmented;
    }

    public function setShipmented(int $Shipmented): self
    {
        $this->Shipmented = $Shipmented;

        return $this;
    }
}
