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
     * @ORM\ManyToOne(targetEntity=Voiture::class, inversedBy="contrats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voiture;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="contrats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Client;

    /**
     * @ORM\OneToOne(targetEntity=Facture::class, mappedBy="Contrat", cascade={"persist", "remove"})
     */
    private $facture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedepart(): ?\DateTimeInterface
    {
        return $this->Datedepart;
    }

    public function setDatedepart( $Datedepart): self
    {
        $this->Datedepart = $Datedepart;

        return $this;
    }

    public function getDateretour(): ?\DateTimeInterface
    {
        return $this->Dateretour;
    }

    public function setDateretour($Dateretour): self
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

    public function getClient(): ?Client
    {
        return $this->Client;
    }

    public function setClient(?Client $Client): self
    {
        $this->Client = $Client;

        return $this;
    }

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(?Facture $facture): self
    {
        $this->facture = $facture;

        // set (or unset) the owning side of the relation if necessary
        $newContrat = null === $facture ? null : $this;
        if ($facture->getContrat() !== $newContrat) {
            $facture->setContrat($newContrat);
        }

        return $this;
    }
    public function getperiode()
    {
        return $this->Dateretour->diff($this->Datedepart)->days;
    }
}