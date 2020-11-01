<?php

namespace App\Entity;

use App\Repository\ZakaziRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ZakaziRepository::class)
 */
class Zakazi
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Amount;

    /**
     * @ORM\ManyToOne(targetEntity=Tovari::class, inversedBy="Code")
     */
    private $Tovar;

    /**
     * @ORM\ManyToOne(targetEntity=Zakazchiki::class, inversedBy="Code")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Zakazchik;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTovar(): ?Tovari
    {
        return $this->Tovar;
    }

    public function setTovar(?Tovari $Tovar): self
    {
        $this->Tovar = $Tovar;

        return $this;
    }

    public function getZakazchik(): ?Zakazchiki
    {
        return $this->Zakazchik;
    }

    public function setZakazchik(?Zakazchiki $Zakazchik): self
    {
        $this->Zakazchik = $Zakazchik;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->Amount;
    }

    public function setAmount(int $Amount): self
    {
        $this->Amount = $Amount;

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getId().':'.$this->getTovar().":".$this->getZakazchik();
    }
}
