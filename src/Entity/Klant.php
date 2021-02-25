<?php

namespace App\Entity;

use App\Repository\KlantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KlantRepository::class)
 */
class Klant
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
    private $klantnaam;

    /**
     * @ORM\Column(type="integer")
     */
    private $telefoonnummer;

    /**
     * @ORM\OneToMany(targetEntity=Reservering::class, mappedBy="klant_id")
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

    public function getKlantnaam(): ?string
    {
        return $this->klantnaam;
    }

    public function setKlantnaam(string $klantnaam): self
    {
        $this->klantnaam = $klantnaam;

        return $this;
    }

    public function getTelefoonnummer(): ?int
    {
        return $this->telefoonnummer;
    }

    public function setTelefoonnummer(int $telefoonnummer): self
    {
        $this->telefoonnummer = $telefoonnummer;

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
            $reservering->setKlantId($this);
        }

        return $this;
    }

    public function removeReservering(Reservering $reservering): self
    {
        if ($this->reserverings->removeElement($reservering)) {
            // set the owning side to null (unless already changed)
            if ($reservering->getKlantId() === $this) {
                $reservering->setKlantId(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getKlantnaam();
    }
}
