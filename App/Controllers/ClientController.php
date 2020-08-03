<?php
declare(strict_types=1);
namespace App\Controllers;

use App\StatusEnum;
use App\Models\Client;
use Rakit\Validation\Validator;
use App\Controllers\BaseController;
use App\Repository\ClientRepository;
use Laminas\Diactoros\ServerRequest;
use App\Repository\IClientRepository;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\Response\JsonResponse;

class ClientController extends BaseController{

    protected $clientRepository;

    public function __construct(IClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function getClients(ServerRequest $request){
        $params = $request->getQueryParams();

        $cleints = $this->clientRepository->getClients($params);
        return $this->OkResponse($cleints);
    }

    public function createClient(ServerRequest $request){
        $validator = new Validator;

        $body = $request->getParsedBody();

        $validation = $validator->make($body, [
            'name' => 'required', 
            'email' => 'required|email',
            'phone' => ['required', $validator('regex', '/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/')
        ]]);

        $validation->validate();

        if ($validation->fails()) {
            return $this->BadRequest($validation->errors()->all(), 'Validation error');
        } else {
            $client = new Client();
            $client->email = $body['email'];
            $client->phone = $body['phone'];
            $client->name = $body['name'];

            $this->clientRepository->createClient($client);

            return $this->OkResponse();
        }
    }

    public function deleteClient(ServerRequest $request){
        $result = $this->clientRepository->deleteClient($request->getAttribute('id'));

        if ($result){
            return $this->OkResponse();
        } else {
            return $this->NotFound([], 'Client not found');
        }
    }
}