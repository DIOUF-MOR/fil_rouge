<?php

namespace App\DataPersister;

use App\Entity\Menu;
use App\Repository\MenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Services\Menuservice;

class MenuDataPersister implements ContextAwareDataPersisterInterface
{
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Menu;
    }
    private Menuservice $menu;

    public function __construct(Menuservice $menu, EntityManagerInterface $mananger)
    {
        $this->menu = $menu;
        $this->mananger = $mananger;
    }

    public function persist($data, array $context = [])
    {
        // call your persistence layer to save $data
       
        $nam=$data->getNamme();
        $data->setNom($nam);
        $prie=$this->menu->prixmenu($data);
    //    dd($prie);
        $data->setPrix($prie);

        $this->mananger->persist($data);
        $this->mananger->flush();
    }

    public function remove($data, array $context = [])
    {
        // call your persistence layer to delete $data
    }
}


