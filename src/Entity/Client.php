<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ApiResource(
    normalizationContext: ["groups"=>["client:read"]]
)]
class Client extends User
{
    #[ORM\Column(type: 'string', length: 50)]
    private $Téléphone;

    #[Groups("client:read")]
    #[ORM\OneToMany(mappedBy: 'clients', targetEntity: Commande::class)]
    private $commandes;

    public function __construct()
    {
        parent::__construct();
        $this->commandes = new ArrayCollection();
    }

    public function getTéléphone(): ?string
    {
        return $this->Téléphone;
    }

    public function setTéléphone(string $Téléphone): self
    {
        $this->Téléphone = $Téléphone;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setClients($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getClients() === $this) {
                $commande->setClients(null);
            }
        }

        return $this;
    }


  
}
