<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ApiResource(
    normalizationContext: ["groups"=>["client:read"]]
)]
class Client extends User
{
    #[ORM\Column(type: 'string', length: 50)]
    private $Téléphone;

    public function getTéléphone(): ?string
    {
        return $this->Téléphone;
    }

    public function setTéléphone(string $Téléphone): self
    {
        $this->Téléphone = $Téléphone;

        return $this;
    }
}
