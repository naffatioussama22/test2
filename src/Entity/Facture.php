<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateDeFacture;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Montant;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $payee;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="factures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Client;

    /**
     * @ORM\OneToOne(targetEntity=Contrat::class, inversedBy="facture", cascade={"persist", "remove"})
     */
    private $Contrat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDeFacture(): ?\DateTimeInterface
    {
        return $this->DateDeFacture;
    }

    public function setDateDeFacture(\DateTimeInterface $DateDeFacture): self
    {
        $this->DateDeFacture = $DateDeFacture;

        return $this;
    }

    public function getMontant(): ?float
    {
      if($this->getContrat())
         return $this->getContrat()->getperiode() * 100;
      return 0;
    }

    public function setMontant(?float $Montant): self
    {
        $this->Montant = $Montant;

        return $this;
    }

    public function getPayee(): ?bool
    {
        return $this->payee;
    }

    public function setPayee(?bool $payee): self
    {
        $this->payee = $payee;

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

    public function getContrat(): ?Contrat
    {
        return $this->Contrat;
    }

    public function setContrat(?Contrat $Contrat): self
    {
        $this->Contrat = $Contrat;

        return $this;
    }
}
