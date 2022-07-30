<?php

namespace App\DataPersister;

// use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Response;

use App\Entity\Frite;
use App\Entity\Boisson;
use App\Entity\Commande;
use App\Entity\Livraison;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Repository\BoissonRepository;
use App\Services\Commandeservice;

class CommandeDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Commande or $data instanceof Livraison;
    }


    public function __construct(Commandeservice $commande, EntityManagerInterface $mananger)
    {
        $this->mananger = $mananger;
        $this->commande = $commande;
    }


    public function persist($data, array $context = [])
    {

        if ($data instanceof Commande) {
            $nbrComplement = 0;
            $lignes = $data->getLignecommandes();
            foreach ($lignes as $ligne) {
                if ($ligne->getProduit() instanceof Boisson or $ligne->getProduit() instanceof Frite) {
                    $nbrComplement++;
                }
            }
            if ($nbrComplement === count($lignes)) {
                return new JsonResponse(['Error' => 'Impossible de commander uniquement les complements'], Response::HTTP_BAD_REQUEST);
            }
        }
       
       
        $montan=$this->commande->prixcommande($data);
        $data->setMontant($montan);
        $this->mananger->persist($data);
        $this->mananger->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function remove($data, array $context = [])
    {

    }
}
