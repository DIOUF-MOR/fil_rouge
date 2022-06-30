<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TailleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TailleRepository::class)]
#[ApiResource()]
class Taille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $libelle;

    #[ORM\ManyToMany(targetEntity: Boisson::class, mappedBy: 'tailles')]
    private $boissons;

    public function __construct()
    {
        $this->boissons = new ArrayCollection();
    }

    // #[ORM\OneToMany(targetEntity: BoissonTaille::class, mappedBy: 'taille')]
    // private $boissonTailles;


    // public function __construct()
    // {
    //     $this->boissonTailles = new ArrayCollection();
    // }

   

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    // public function getLibelle(): ?string
    // {
    //     return $this->libelle;
    // }

    // public function setLibelle(string $libelle): self
    // {
    //     $this->libelle = $libelle;

    //     return $this;
    // }

    // /**
    //  * @return Collection<int, Boisson>
    //  */
    // public function getBoissons(): Collection
    // {
    //     return $this->boissons;
    // }

    // public function addBoisson(Boisson $boisson): self
    // {
    //     if (!$this->boissons->contains($boisson)) {
    //         $this->boissons[] = $boisson;
    //         $boisson->addTaille($this);
    //     }

    //     return $this;
    // }

    // public function removeBoisson(Boisson $boisson): self
    // {
    //     if ($this->boissons->removeElement($boisson)) {
    //         $boisson->removeTaille($this);
    //     }

    //     return $this;
    // }


    /**
     * Get the value of boissonTailles
     */ 
    // public function getBoissonTailles()
    // {
    //     return $this->boissonTailles;
    // }

    // /**
    //  * Set the value of boissonTailles
    //  *
    //  * @return  self
    //  */ 
    // public function setBoissonTailles($boissonTailles)
    // {
    //     $this->boissonTailles = $boissonTailles;

    //     return $this;
    // }

    /**
     * @return Collection<int, Boisson>
     */
    public function getBoissons(): Collection
    {
        return $this->boissons;
    }

    public function addBoisson(Boisson $boisson): self
    {
        if (!$this->boissons->contains($boisson)) {
            $this->boissons[] = $boisson;
            $boisson->addTaille($this);
        }

        return $this;
    }

    public function removeBoisson(Boisson $boisson): self
    {
        if ($this->boissons->removeElement($boisson)) {
            $boisson->removeTaille($this);
        }

        return $this;
    }

    /**
     * Get the value of libelle
     */ 
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set the value of libelle
     *
     * @return  self
     */ 
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
