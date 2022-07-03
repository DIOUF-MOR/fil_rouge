<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BurgerRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
// #[ApiResource(
  
//     normalizationContext: ["groups"=>["burger:read","lignecommandes:read","commande:read"]]
// )]
class Burger extends Produit
{
    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'burgers')]
    private $menus;

    public function __construct()
    {
        parent::__construct();
        $this->menus = new ArrayCollection();
    }

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
            $menu->addBurger($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            $menu->removeBurger($this);
        }

        return $this;
    }
}
