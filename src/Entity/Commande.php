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
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource(
    normalizationContext: ["groups"=>["commande:read"]],
    denormalizationContext: ["groups"=>["commande:write"]]
)]
class Commande
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    
    #[Groups(["commande:read"])]
    #[ORM\Column(type: 'float', nullable: true)]
    private $montant;
    
    // #[Groups(["commande:read","commande:write"])]
    #[ORM\Column(type: 'date', nullable: true)]
    private $date;

    // #[Groups(["commande:read","commande:write"])]
    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $numeroCommande;

    // #[Groups(["commande:read"])]
    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'commandes')]
    private $gestionnaire;

    #[ORM\ManyToOne(targetEntity: Livraison::class, inversedBy: 'commandes')]
    private $livraison;

    #[Groups(["commande:read","commande:write"])]
    #[ORM\ManyToMany(targetEntity: Lignecommande::class, inversedBy: 'commandes',cascade:["persist"])]
    #[SerializedName("Produits")]
    private $lignecommandes;

    // #[Groups(["commande:read","commande:write"])]
    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'commandes')]
    private $clients;

    #[Groups(["commande:read","commande:write"])]
    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $etat;

    #[Groups(["commande:read","commande:write"])]
    #[ORM\ManyToOne(targetEntity: Zone::class, inversedBy: 'commandes')]
    private $zone;


    public function __construct()
    {
        // $this->clients = new ArrayCollection();
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
        }

        return $this;
    }

    public function removeLignecommande(Lignecommande $lignecommande): self
    {
        $this->lignecommandes->removeElement($lignecommande);

        return $this;
    }

    public function getClients(): ?Client
    {
        return $this->clients;
    }

    public function setClients(?Client $clients): self
    {
        $this->clients = $clients;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

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


   

}
