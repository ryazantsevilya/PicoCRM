<?php
declare(strict_types=1);

use App\Controllers\ClientController;

return [
    ['GET', '/api/client', [ClientController::class, 'getClients']],
    ['POST','/api/client',[ClientController::class, 'createClient']],
    ['DELETE','/api/client/{id:\d+}',[ClientController::class, 'deleteClient']]
];




