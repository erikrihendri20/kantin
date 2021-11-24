<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PenjualFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        session();
        if(session()->role!=3){
            return redirect()->to(base_url('Pembeli/Pesan/menu'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}