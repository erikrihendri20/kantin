<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthApiFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $response = \Config\Services::response();
        $api_key = $request->getGet('api_key');
        if(!$api_key){
            $response->setStatusCode(401);
            $response->setHeader('Content-Type', 'json');
            $response->setBody(json_encode(['status' => 'error', 'message' => 'required api_key']));
            return $response;
        }
        $api_model = new \App\Models\DevApiModel();
        $api_data = $api_model->where('api_key', $api_key)->first();
        if(!$api_data){
            
            $response->setStatusCode(401);
            $response->setHeader('Content-Type', 'json');
            $response->setBody(json_encode(['status' => 'error', 'message' => 'api not found']));
            return $response;
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        // dd($request->getPath());
    }
}