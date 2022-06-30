<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivreurRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: LivreurRepository::class)]
#[ApiResource(
    normalizationContext: ["groups"=>["livreur:read"]]
)]
class Livreur extends User
{

}
