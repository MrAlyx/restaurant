<?php

namespace App\Entity;

use App\Repository\BestellingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BestellingRepository::class)
 */
class Bestelling
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=MenuItem::class, inversedBy="bestellings")
     */
    private $menuItem_id;

    /**
     * @ORM\ManyToOne(targetEntity=Reservering::class, inversedBy="bestellings")
     */
    private $reservering_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $aantal;

    /**
     * @ORM\Column(type="boolean")
     */
    private $staat_klaar;

    /**
     * @ORM\ManyToOne(targetEntity=Gerecht::class, inversedBy="bestellings")
     */
    private $gerecht;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenuItemId(): ?menuItem
    {
        return $this->menuItem_id;
    }

    public function setMenuItemId(?menuItem $menuItem_id): self
    {
        $this->menuItem_id = $menuItem_id;

        return $this;
    }

    public function getReserveringId(): ?reservering
    {
        return $this->reservering_id;
    }

    public function setReserveringId(?reservering $reservering_id): self
    {
        $this->reservering_id = $reservering_id;

        return $this;
    }

    public function getAantal(): ?int
    {
        return $this->aantal;
    }

    public function setAantal(int $aantal): self
    {
        $this->aantal = $aantal;

        return $this;
    }

    public function getStaatKlaar(): ?bool
    {
        return $this->staat_klaar;
    }

    public function setStaatKlaar(bool $staat_klaar): self
    {
        $this->staat_klaar = $staat_klaar;

        return $this;
    }

    public function getGerecht(): ?Gerecht
    {
        return $this->gerecht;
    }

    public function setGerecht(?Gerecht $gerecht): self
    {
        $this->gerecht = $gerecht;

        return $this;
    }
}
