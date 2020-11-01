<?php

namespace App\Entity;

use App\Repository\ZakazchikiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ZakazchikiRepository::class)
 */
class Zakazchiki
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
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Score;

    /**
     * @ORM\OneToMany(targetEntity=Zakazi::class, mappedBy="Zakazchik")
     */
    private $Code;

    public function __construct()
    {
        $this->Code = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->Score;
    }

    public function setScore(string $Score): self
    {
        $this->Score = $Score;

        return $this;
    }

    /**
     * @return Collection|Zakazi[]
     */
    public function getCode(): Collection
    {
        return $this->Code;
    }

    public function addCode(Zakazi $code): self
    {
        if (!$this->Code->contains($code)) {
            $this->Code[] = $code;
            $code->setZakazchik($this);
        }

        return $this;
    }

    public function removeCode(Zakazi $code): self
    {
        if ($this->Code->removeElement($code)) {
            // set the owning side to null (unless already changed)
            if ($code->getZakazchik() === $this) {
                $code->setZakazchik(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getName();
    }
}
