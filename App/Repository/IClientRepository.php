<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Client;

interface IClientRepository {

    public function getClients () : array;
    public function createClient (Client $client);
    public function deleteClient($id): bool;
}