<?php

namespace App\Entity;

use App\Entity\Zone;
use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource(
    normalizationContext: ["groups"=>["commande:read"]]
)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

  

    #[Groups(["commande:read"])]
    #[ORM\Column(type: 'date')]
    private $date;


    #[Groups(["commande:read"])]
    #[ORM\Column(type: 'float')]
    private $montant;

    #[Groups(["commande:read"])]
    #[ORM\ManyToOne(targetEntity: Zone::class, inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private $zone;

    #[Groups(["commande:read"])]
    #[ORM\Column(type: 'string', length: 50)]
    private $numeroCommande;

    #[Groups(["commande:read"])]
    #[ORM\ManyToMany(targetEntity: Client::class, mappedBy: 'commandes')]
    private $clients;

    #[Groups(["commande:read"])]
    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'commandes')]
    private $gestionnaire;

    #[ORM\ManyToOne(targetEntity: Livraison::class, inversedBy: 'commandes')]
    private $livraison;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: Lignecommande::class)]
    private $lignecommandes;


    public function __construct()
    {
        $this->clients = new ArrayCollection();
        $this->lignecommandes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

   


    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getZone(): ?Zone
    {
        return $this->zone;
    }

    public function setZone(?Zone $zone): self
    {
        $this->zone = $zone;

        return $this;
    }

    public function getNumeroCommande(): ?string
    {
        return $this->numeroCommande;
    }

    public function setNumeroCommande(string $numeroCommande): self
    {
        $this->numeroCommande = $numeroCommande;

        return $this;
    }


   

    public function getGestionnaire(): ?Gestionnaire
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?Gestionnaire $gestionnaire): self
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }

    public function getLivraison(): ?Livraison
    {
        return $this->livraison;
    }

    public function setLivraison(?Livraison $livraison): self
    {
        $this->livraison = $livraison;

        return $this;
    }

    /**
     * Get the value of clients
     */ 
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * @return Collection<int, Lignecommande>
     */
    public function getLignecommandes(): Collection
    {
        return $this->lignecommandes;
    }

    public function addLignecommande(Lignecommande $lignecommande): self
    {
        if (!$this->lignecommandes->contains($lignecommande)) {
            $this->lignecommandes[] = $lignecommande;
            $lignecommande->setCommande($this);
        }

        return $this;
    }

    public function removeLignecommande(Lignecommande $lignecommande): self
    {
        if ($this->lignecommandes->removeElement($lignecommande)) {
            // set the owning side to null (unless already changed)
            if ($lignecommande->getCommande() === $this) {
                $lignecommande->setCommande(null);
            }
        }

        return $this;
    }

   
}
