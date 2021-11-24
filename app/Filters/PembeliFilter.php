<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PembeliFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        session();
        if(session()->role!=4){
            return redirect()->to(base_url('Admin/Home/index'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}