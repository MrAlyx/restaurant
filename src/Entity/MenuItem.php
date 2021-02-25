<?php

namespace App\Entity;

use App\Repository\MenuItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MenuItemRepository::class)
 */
class MenuItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Subgerecht::class, inversedBy="menuItems")
     */
    private $subgerecht_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $menuItem;

    /**
     * @ORM\Column(type="float")
     */
    private $prijs;

    /**
     * @ORM\OneToMany(targetEntity=Bestelling::class, mappedBy="menuItem_id", orphanRemoval=true)
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

    public function getSubgerechtId(): ?subgerecht
    {
        return $this->subgerecht_id;
    }

    public function setSubgerechtId(?subgerecht $subgerecht_id): self
    {
        $this->subgerecht_id = $subgerecht_id;

        return $this;
    }

    public function getMenuItem(): ?string
    {
        return $this->menuItem;
    }

    public function setMenuItem(string $menuItem): self
    {
        $this->menuItem = $menuItem;

        return $this;
    }

    public function getPrijs(): ?float
    {
        return $this->prijs;
    }

    public function setPrijs(float $prijs): self
    {
        $this->prijs = $prijs;

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
            $bestelling->setMenuItemId($this);
        }

        return $this;
    }

    public function removeBestelling(Bestelling $bestelling): self
    {
        if ($this->bestellings->removeElement($bestelling)) {
            // set the owning side to null (unless already changed)
            if ($bestelling->getMenuItemId() === $this) {
                $bestelling->setMenuItemId(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getMenuItem();
    }
}
