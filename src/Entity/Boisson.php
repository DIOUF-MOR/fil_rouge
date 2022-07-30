<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BoissonRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BoissonRepository::class)]
#[ApiResource(
    normalizationContext: ["groups" => ["boisson:read"]],
    denormalizationContext: ["groups" => ["boisson:write"]]
)]
class Boisson extends Produit
{


  
    #[ORM\OneToMany(mappedBy: 'boisson', targetEntity: Boissontaille::class)]
    private $boissontailles;


    public function __construct()
    {
        parent::__construct();
        $this->boissontailles = new ArrayCollection();
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
            $boissontaille->setBoisson($this);
        }

        return $this;
    }

    public function removeBoissontaille(Boissontaille $boissontaille): self
    {
        if ($this->boissontailles->removeElement($boissontaille)) {
            // set the owning side to null (unless already changed)
            if ($boissontaille->getBoisson() === $this) {
                $boissontaille->setBoisson(null);
            }
        }

        return $this;
    }
}
