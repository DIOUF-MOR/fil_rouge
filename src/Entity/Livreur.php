<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivreurRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: LivreurRepository::class)]
#[ApiResource(
    normalizationContext: ["groups" => ["livreur:read"]]
)]
class Livreur extends User
{
    #[ORM\Column(type: 'string', length: 40)]
    private $telephone;

    #[ORM\Column(type: 'string', length: 255)]
    private $matricule_moto;

    public function __construct()
    {
        $matricule = "MOTO" . Date('dmyhis');
        $this->matricule_moto = $matricule;
        $table = get_called_class();
        $table = explode('\\', $table);
        $table = strtoupper($table[2]);
        $this->roles[] = 'ROLE_VISITEUR';
        $this->roles[] = 'ROLE_' . $table;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMatriculeMoto(): ?string
    {
        return $this->matricule_moto;
    }

    public function setMatriculeMoto(string $matricule_moto): self
    {
        $this->matricule_moto = $matricule_moto;

        return $this;
    }
}
