<?php

namespace App\Entity;

use App\Repository\GerechtRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GerechtRepository::class)
 */
class Gerecht
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
    private $naam;

    /**
     * @ORM\OneToMany(targetEntity=Subgerecht::class, mappedBy="gerecht_id")
     */
    private $subgerechts;

    /**
     * @ORM\OneToMany(targetEntity=Bestelling::class, mappedBy="gerecht")
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

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    /**
     * @return Collection|Subgerecht[]
     */
    public function getSubgerechts(): Collection
    {
        return $this->subgerechts;
    }

    public function addSubgerecht(Subgerecht $subgerecht): self
    {
        if (!$this->subgerechts->contains($subgerecht)) {
            $this->subgerechts[] = $subgerecht;
            $subgerecht->setGerechtId($this);
        }

        return $this;
    }

    public function removeSubgerecht(Subgerecht $subgerecht): self
    {
        if ($this->subgerechts->removeElement($subgerecht)) {
            // set the owning side to null (unless already changed)
            if ($subgerecht->getGerechtId() === $this) {
                $subgerecht->setGerechtId(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNaam();
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
            $bestelling->setGerecht($this);
        }

        return $this;
    }

    public function removeBestelling(Bestelling $bestelling): self
    {
        if ($this->bestellings->removeElement($bestelling)) {
            // set the owning side to null (unless already changed)
            if ($bestelling->getGerecht() === $this) {
                $bestelling->setGerecht(null);
            }
        }

        return $this;
    }

}
