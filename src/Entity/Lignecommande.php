<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LignecommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LignecommandeRepository::class)]
// #[ApiResource(
//     normalizationContext: ["groups"=>["lignecommande:read","commande:read"]]
// )]
class Lignecommande
{

    #[Groups(["lignecommandes:read","commande:read"])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    
    #[Groups(["lignecommandes:read","commande:read"])]
    #[ORM\Column(type: 'string', length: 100)]
    protected $quantité;

    #[Groups(["lignecommandes:read","commande:read"])]
    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'lignecommandes')]
    protected $produit;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'lignecommandes')]
    protected $commande;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantité(): ?string
    {
        return $this->quantité;
    }

    public function setQuantité(string $quantité): self
    {
        $this->quantité = $quantité;

        return $this;
    }



    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

 

   

}
