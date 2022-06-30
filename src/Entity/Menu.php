<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ApiResource(
    normalizationContext: ["groups"=>["menu:read"]]
)]
class Menu extends Produit
{
    #[ORM\ManyToMany(targetEntity: Burger::class, inversedBy: 'menus')]
    private $burgers;

    #[ORM\ManyToMany(targetEntity: Frite::class, inversedBy: 'menus')]
    private $frites;

    #[ORM\ManyToMany(targetEntity: Tailleboisson::class, inversedBy: 'menus')]
    private $tailleboissons;


    public function __construct()
    {
        parent::__construct();
        $this->burgers = new ArrayCollection();
        $this->frites = new ArrayCollection();
        $this->tailleboissons = new ArrayCollection();
       
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
        }

        return $this;
    }

    public function removeFrite(Frite $frite): self
    {
        $this->frites->removeElement($frite);

        return $this;
    }

    /**
     * @return Collection<int, Tailleboisson>
     */
    public function getTailleboissons(): Collection
    {
        return $this->tailleboissons;
    }

    public function addTailleboisson(Tailleboisson $tailleboisson): self
    {
        if (!$this->tailleboissons->contains($tailleboisson)) {
            $this->tailleboissons[] = $tailleboisson;
        }

        return $this;
    }

    public function removeTailleboisson(Tailleboisson $tailleboisson): self
    {
        $this->tailleboissons->removeElement($tailleboisson);

        return $this;
    }

   
}
