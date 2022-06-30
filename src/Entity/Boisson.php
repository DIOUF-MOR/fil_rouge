<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BoissonRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: BoissonRepository::class)]
#[ApiResource(
    normalizationContext: ["groups"=>["boisson:read"]]
)]
class Boisson extends Produit
{
    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'boissons')]
    private $menus;

    #[ORM\ManyToMany(targetEntity: Taille::class, inversedBy: 'boissons')]
    private $tailles;

    public function __construct()
    {
        parent::__construct();
        $this->menus = new ArrayCollection();
        $this->tailles = new ArrayCollection();
    }

    // #[ORM\OneToMany(targetEntity: BoissonTaille::class, mappedBy: 'boisson')]
    // private $boissonTailles;

    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->boissonTailles = new ArrayCollection();
    // }

    /**
     * Get the value of boissonTailles
     */ 
    // public function getBoissonTailles()
    // {
    //     return $this->boissonTailles;
    // }

    /**
     * Set the value of boissonTailles
     *
     * @return  self
     */ 
    // public function setBoissonTailles($boissonTailles)
    // {
    //     $this->boissonTailles = $boissonTailles;

    //     return $this;
    // }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->addBoisson($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            $menu->removeBoisson($this);
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
