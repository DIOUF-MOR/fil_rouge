<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
// #[ApiResource(
//     normalizationContext: ["groups"=>["menu:read","lignecommandes:read","commande:read"]]
// )]
class Menu extends Produit
{
    #[ORM\ManyToMany(targetEntity: Burger::class, inversedBy: 'menus')]
    private $burgers;

    #[ORM\ManyToMany(targetEntity: Frite::class, mappedBy: 'menus')]
    private $frites;

    #[ORM\ManyToMany(targetEntity: Taille::class, inversedBy: 'menus')]
    private $tailles;



    public function __construct()
    {
        parent::__construct();
        $this->burgers = new ArrayCollection();
        $this->frites = new ArrayCollection();
        $this->tailles = new ArrayCollection();
       
       
    }

    /**
     * @return Collection<int, Burger>
     */
    public function getBurgers(): Collection
    {
        return $this->burgers;
    }

    public function addBurger(Burger $burger): self
    {
        if (!$this->burgers->contains($burger)) {
            $this->burgers[] = $burger;
        }

        return $this;
    }

    public function removeBurger(Burger $burger): self
    {
        $this->burgers->removeElement($burger);

        return $this;
    }
    /**
     * @return Collection<int, Frite>
     */
    public function getFrites(): Collection
    {
        return $this->frites;
    }

    public function addFrite(Frite $frite): self
    {
        if (!$this->frites->contains($frite)) {
            $this->frites[] = $frite;
            $frite->addMenu($this);
        }

        return $this;
    }

    public function removeFrite(Frite $frite): self
    {
        if ($this->frites->removeElement($frite)) {
            $frite->removeMenu($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Taille>
     */
    public function getTailles(): Collection
    {
        return $this->tailles;
    }

    public function addTaille(Taille $taille): self
    {
        if (!$this->tailles->contains($taille)) {
            $this->tailles[] = $taille;
        }

        return $this;
    }

    public function removeTaille(Taille $taille): self
    {
        $this->tailles->removeElement($taille);

        return $this;
    }
   
}
