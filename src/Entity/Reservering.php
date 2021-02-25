<?php

namespace App\Entity;

use App\Repository\ReserveringRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReserveringRepository::class)
 */
class Reservering
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Klant::class, inversedBy="reserverings")
     */
    private $klant_id;

    /**
     * @ORM\ManyToOne(targetEntity=Tafel::class, inversedBy="reserverings", cascade={"persist", "remove"})
     */
    private $tafel_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $aantalPersonen;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datum_tijd;

    /**
     * @ORM\OneToMany(targetEntity=Bestelling::class, mappedBy="reservering_id")
     */
    private $bestellings;

    public function __construct()
    {
        $this->bestellings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKlantId(): ?klant
    {
        return $this->klant_id;
    }

    public function setKlantId(?klant $klant_id): self
    {
        $this->klant_id = $klant_id;

        return $this;
    }

    public function getTafelId(): ?tafel
    {
        return $this->tafel_id;
    }

    public function setTafelId(?tafel $tafel_id): self
    {
        $this->tafel_id = $tafel_id;

        return $this;
    }

    public function getAantalPersonen(): ?int
    {
        return $this->aantalPersonen;
    }

    public function setAantalPersonen(int $aantalPersonen): self
    {
        $this->aantalPersonen = $aantalPersonen;

        return $this;
    }

    public function getDatumTijd(): ?\DateTimeInterface
    {
        return $this->datum_tijd;
    }

    public function setDatumTijd(\DateTimeInterface $datum_tijd): self
    {
        $this->datum_tijd = $datum_tijd;

        return $this;
    }

    /**
     * @return Collection|Bestelling[]
     */
    public function getBestellings(): Collection
    {
        return $this->bestellings;
    }

    public function addBestelling(Bestelling $bestelling): self
    {
        if (!$this->bestellings->contains($bestelling)) {
            $this->bestellings[] = $bestelling;
            $bestelling->setReserveringId($this);
        }

        return $this;
    }

    public function removeBestelling(Bestelling $bestelling): self
    {
        if ($this->bestellings->removeElement($bestelling)) {
            // set the owning side to null (unless already changed)
            if ($bestelling->getReserveringId() === $this) {
                $bestelling->setReserveringId(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getKlantId();
    }
}
