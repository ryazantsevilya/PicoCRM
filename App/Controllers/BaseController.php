<?php
declare(strict_types=1);
namespace App\Controllers;

use App\StatusEnum;
use Laminas\Diactoros\Response\JsonResponse;

class BaseController {

    protected $response;

    public function __construct()
    {
        $this->response = new JsonResponse([],200);
    }

    public function OkResponse($data, $message = ''){
        $responseData = [
            "status"=> "OK",
            "data" => $data,
            'msg' => $message
        ];
        return $this->response->withPayload($responseData);
    }

    public function Error($data, $message = ''){
        $responseData = [
            "status"=> "ERROR",
            "data" => $data,
            'msg' => $message
        ];
        return $this->response->withPayload($responseData);
    }
}