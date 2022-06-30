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

    #[ORM\ManyToMany(targetEntity: Tailleboisson::class, mappedBy: 'boissons')]
    private $tailleboissons;

    public function __construct()
    {
        parent::__construct();
        $this->menus = new ArrayCollection();
        $this->tailleboissons = new ArrayCollection();
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
            $tailleboisson->addBoisson($this);
        }

        return $this;
    }

    public function removeTailleboisson(Tailleboisson $tailleboisson): self
    {
        if ($this->tailleboissons->removeElement($tailleboisson)) {
            $tailleboisson->removeBoisson($this);
        }

        return $this;
    }
}
