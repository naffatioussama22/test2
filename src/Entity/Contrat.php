<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 */
class Contrat
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
    private $Datedepart;

    /**
     * @ORM\Column(type="date")
     */
    private $Dateretour;

    /**
     * @ORM\Column(type="integer")
     */
    private $Kmdepart;

    /**
     * @ORM\Column(type="integer")
     */
    private $Kmretour;

    /**
     * @ORM\ManyToOne(targetEntity=Voiture::class, inversedBy="contracts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voiture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedepart(): ?\DateTimeInterface
    {
        return $this->Datedepart;
    }

    public function setDatedepart(\DateTimeInterface $Datedepart): self
    {
        $this->Datedepart = $Datedepart;

        return $this;
    }

    public function getDateretour(): ?\DateTimeInterface
    {
        return $this->Dateretour;
    }

    public function setDateretour(\DateTimeInterface $Dateretour): self
    {
        $this->Dateretour = $Dateretour;

        return $this;
    }

    public function getKmdepart(): ?int
    {
        return $this->Kmdepart;
    }

    public function setKmdepart(int $Kmdepart): self
    {
        $this->Kmdepart = $Kmdepart;

        return $this;
    }

    public function getKmretour(): ?int
    {
        return $this->Kmretour;
    }

    public function setKmretour(int $Kmretour): self
    {
        $this->Kmretour = $Kmretour;

        return $this;
    }

    public function getVoiture(): ?Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?Voiture $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }
}