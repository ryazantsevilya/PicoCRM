<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Client;
use Doctrine\ORM\EntityRepository;
use App\Repository\IClientRepository;

class ClientRepository implements IClientRepository {

    private $clientRepository;
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->clientRepository = $entityManager->getRepository('App\Models\Client');
    }

    public function getClients ($params = null) : array 
    {
        if ($params){
            return $this->clientRepository->findBy($params);
        } else {
            return $this->clientRepository->findAll();
        }
    }

    public function createClient (Client $client)
    {
        $this->entityManager->persist($client);
        $this->entityManager->flush();
    }

    public function deleteClient($id): bool
    {
        $client = $this->clientRepository->find($id);

        if ($client){
            try{
                $this->entityManager->remove($client);
                $this->entityManager->flush();
                return True;
            }
            catch(Exception $e)
            {
                return false;
            }
        } else {
            return false;
        }
    }
}