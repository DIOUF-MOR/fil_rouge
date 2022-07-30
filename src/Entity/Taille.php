<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TailleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TailleRepository::class)]
#[ApiResource(
    normalizationContext:["groups"=>["taille:read","menu:read"]],
    // denormalizationContext:["groups"=>["taille:read","menu:write"]]
)]
class Taille
{
    #[Groups(["taille:read","menu:read"])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(["boisson:read"])]
    #[ORM\Column(type: 'string', length: 50)]
    private $libelle;

    #[ORM\OneToMany(mappedBy: 'taille', targetEntity: Menutaille::class)]
    private $menutailles;

     #[Groups(["boisson:read","taille:read","taille:write","menu:read","commande:read"])]
    #[ORM\Column(type: 'integer', nullable: true)]
    private $prix;

     #[ORM\OneToMany(mappedBy: 'taille', targetEntity: Boissontaille::class)]
     private $boissontailles;



    public function __construct()
    {
        $this->menutailles = new ArrayCollection();
        $this->boissontailles = new ArrayCollection();
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

    /**
     * @return Collection<int, Menutaille>
     */
    public function getMenutailles(): Collection
    {
        return $this->menutailles;
    }

    public function addMenutaille(Menutaille $menutaille): self
    {
        if (!$this->menutailles->contains($menutaille)) {
            $this->menutailles[] = $menutaille;
            $menutaille->setTaille($this);
        }

        return $this;
    }

    public function removeMenutaille(Menutaille $menutaille): self
    {
        if ($this->menutailles->removeElement($menutaille)) {
            // set the owning side to null (unless already changed)
            if ($menutaille->getTaille() === $this) {
                $menutaille->setTaille(null);
            }
        }

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, Boissontaille>
     */
    public function getBoissontailles(): Collection
    {
        return $this->boissontailles;
    }

    public function addBoissontaille(Boissontaille $boissontaille): self
    {
        if (!$this->boissontailles->contains($boissontaille)) {
            $this->boissontailles[] = $boissontaille;
            $boissontaille->setTaille($this);
        }

        return $this;
    }

    public function removeBoissontaille(Boissontaille $boissontaille): self
    {
        if ($this->boissontailles->removeElement($boissontaille)) {
            if ($boissontaille->getTaille() === $this) {
                $boissontaille->setTaille(null);
            }
        }

        return $this;
    }



}
