<?php
declare(strict_types=1);
namespace App\Controllers;

use App\StatusEnum;
use Laminas\Diactoros\Response\JsonResponse;

class BaseController {

    protected $response;

    public function OkResponse($data = null, $message = ''){
        $this->response = new JsonResponse([],200);
        $responseData = [
            "status"=> "OK",
            "data" => $data,
            'msg' => $message
        ];
        return $this->response->withPayload($responseData);
    }

    public function NotFound($data = null, $message = ''){
        $this->response = new JsonResponse([],404);
        $responseData = [
            "status"=> "OK",
            "data" => $data,
            'msg' => $message
        ];
        return $this->response->withPayload($responseData);
    }

    public function Error($data, $message = ''){
        $this->response = new JsonResponse([],500);
        $responseData = [
            "status"=> "ERROR",
            "data" => $data,
            'msg' => $message
        ];
        return $this->response->withPayload($responseData);
    }

    public function BadRequest($data, $message = ''){
        $this->response = new JsonResponse([],400);
        $responseData = [
            "status"=> "BAD_REQUEST",
            "data" => $data,
            'msg' => $message
        ];
        return $this->response->withPayload($responseData);
    }
}