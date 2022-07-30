<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BoissontailleRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BoissontailleRepository::class)]
#[ApiResource(
    normalizationContext:["groups"=>["Boissontaille:reaf"]]
)]
class Boissontaille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(["lignecommande:read","lignecommande:write"])]
    #[ORM\Column(type: 'integer', nullable: true)]
    private $quantiteStock;

    #[Groups(["lignecommande:read","lignecommande:write"])]
    #[ORM\ManyToOne(targetEntity: Boisson::class, inversedBy: 'boissontailles')]
    private $boisson;

    #[Groups(["lignecommande:read","lignecommande:write"])]
    #[ORM\ManyToOne(targetEntity: Taille::class, inversedBy: 'boissontailles')]
    private $taille;

    #[ORM\ManyToOne(targetEntity: Lignecommande::class, inversedBy: 'boissontailles')]
    private $lignecommande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantiteStock(): ?int
    {
        return $this->quantiteStock;
    }

    public function setQuantiteStock(?int $quantiteStock): self
    {
        $this->quantiteStock = $quantiteStock;

        return $this;
    }

    public function getBoisson(): ?Boisson
    {
        return $this->boisson;
    }

    public function setBoisson(?Boisson $boisson): self
    {
        $this->boisson = $boisson;

        return $this;
    }

    public function getTaille(): ?Taille
    {
        return $this->taille;
    }

    public function setTaille(?Taille $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getLignecommande(): ?Lignecommande
    {
        return $this->lignecommande;
    }

    public function setLignecommande(?Lignecommande $lignecommande): self
    {
        $this->lignecommande = $lignecommande;

        return $this;
    }
}
