<?php

namespace App\Entity;

use App\Repository\AgenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AgenceRepository::class)
 */
class Agence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $telagence;

    /**
     * @ORM\Column(type="string", length=160)
     */
    private $adresseville;

    /**
     * @ORM\OneToMany(targetEntity=Voiture::class, mappedBy="agence")
     */
    private $Voiture;

    public function __construct()
    {
        $this->Voiture = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getTelagence(): ?string
    {
        return $this->telagence;
    }

    public function setTelagence(string $telagence): self
    {
        $this->telagence = $telagence;

        return $this;
    }

    public function getAdresseville(): ?string
    {
        return $this->adresseville;
    }

    public function setAdresseville(string $adresseville): self
    {
        $this->adresseville = $adresseville;

        return $this;
    }

    /**
     * @return Collection|Voiture[]
     */
    public function getVoiture(): Collection
    {
        return $this->Voiture;
    }

    public function addVoiture(Voiture $voiture): self
    {
        if (!$this->Voiture->contains($voiture)) {
            $this->Voiture[] = $voiture;
            $voiture->setAgence($this);
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): self
    {
        if ($this->Voiture->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getAgence() === $this) {
                $voiture->setAgence(null);
            }
        }

        return $this;
    }
}
