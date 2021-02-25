<?php

namespace App\Entity;

use App\Repository\TafelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TafelRepository::class)
 */
class Tafel
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
    private $tafelnummer;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_personen;

    /**
     * @ORM\OneToMany(targetEntity=Reservering::class, mappedBy="tafel_id")
     */
    private $reserverings;

    public function __construct()
    {
        $this->reserverings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTafelnummer(): ?int
    {
        return $this->tafelnummer;
    }

    public function setTafelnummer(int $tafelnummer): self
    {
        $this->tafelnummer = $tafelnummer;

        return $this;
    }

    public function getMaxPersonen(): ?int
    {
        return $this->max_personen;
    }

    public function setMaxPersonen(int $max_personen): self
    {
        $this->max_personen = $max_personen;

        return $this;
    }

    /**
     * @return Collection|Reservering[]
     */
    public function getReserverings(): Collection
    {
        return $this->reserverings;
    }

    public function addReservering(Reservering $reservering): self
    {
        if (!$this->reserverings->contains($reservering)) {
            $this->reserverings[] = $reservering;
            $reservering->setTafelId($this);
        }

        return $this;
    }

    public function removeReservering(Reservering $reservering): self
    {
        if ($this->reserverings->removeElement($reservering)) {
            // set the owning side to null (unless already changed)
            if ($reservering->getTafelId() === $this) {
                $reservering->setTafelId(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return "Tafelnummer ".$this->getId(). ", max. ".$this->getMaxPersonen()." personen";
    }
}
