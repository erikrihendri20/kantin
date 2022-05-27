<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthDevFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        session();
        if(!session()->dev_log){
            return redirect()->to(base_url('Dev/Documentation'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        // dd($request->getPath());
    }
}