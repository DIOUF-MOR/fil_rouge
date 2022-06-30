<?php

namespace App\Entity;

use App\Entity\Commande;
use App\Entity\Gestionnaire;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name:"genre",type:"string")]
#[ORM\DiscriminatorMap(["burger"=>"Burger","menu"=>"Menu","boisson"=>"Boisson","frite"=>"Frite"])]
#[ApiResource(
    normalizationContext: ["groups"=>["produit:read"]]
)]
class Produit 
{
    #[Groups(["burger:read","boisson:read","menu:read","frite:read"])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[Groups(["burger:read","boisson:read","menu:read","frite:read"])]
    #[ORM\Column(type: 'string', length: 50)]
    protected $nom;

    
    #[Groups(["burger:read","boisson:read","menu:read","frite:read"])]
    #[ORM\Column(type: 'float')]
    protected $prix;

    #[ORM\ManyToMany(targetEntity: Commande::class, mappedBy: 'produits')]
    protected $commandes;

   
    #[Groups(["burger:read","boisson:read","menu:read","frite:read"])]
    #[ORM\Column(type: 'text')]
    protected $image;

    #[Groups(["burger:read","boisson:read","menu:read","frite:read"])]
    #[ORM\Column(type: 'integer')]
    protected $etat;

    #[Groups(["burger:read","boisson:read","menu:read","frite:read"])]
    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'produits')]
    protected $gestionnaire;

    #[Groups(["burger:read","boisson:read","menu:read","frite:read"])]
    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    protected $description;



    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->addProduit($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            $commande->removeProduit($this);
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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

    public function getGestionnaire(): ?Gestionnaire
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?Gestionnaire $gestionnaire): self
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

}
