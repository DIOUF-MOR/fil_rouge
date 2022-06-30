<?php

namespace App\Entity;

use App\Repository\AnnonymeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnonymeRepository::class)]
class Annonyme extends Personne
{
   
}
