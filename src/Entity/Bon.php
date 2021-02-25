<?php

namespace App\Entity;

use App\Repository\BonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BonRepository::class)
 */
class Bon
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Reservering::class, cascade={"persist", "remove"})
     */
    private $reservering_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datum_tijd;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDatumTijd(): ?\DateTimeInterface
    {
        return $this->datum_tijd;
    }

    public function setDatumTijd(\DateTimeInterface $datum_tijd): self
    {
        $this->datum_tijd = $datum_tijd;

        return $this;
    }


}
