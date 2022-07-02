<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FriteRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: FriteRepository::class)]
#[ApiResource(
    normalizationContext: ["groups"=>["frite:read"]]
)]
class Frite extends Produit
{
   

    #[ORM\ManyToMany(targetEntity: Menu::class, inversedBy: 'frites')]
    private $menus;

    public function __construct()
    {
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
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        $this->menus->removeElement($menu);

        return $this;
    }
}