<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        session();
        if(!session()->log){
            return redirect()->to(base_url('auth/login'));
        }
        $role = session()->role;
        switch ($role) {
            case '1':
                if($request->getUri()->getSegment(1)!='Admin'){
                    return redirect()->to(base_url('Admin/Home'));
                }
                break;

            case '2':
                if($request->getUri()->getSegment(1)!='Admin'){
                    return redirect()->to(base_url('Admin/Home'));
                }
                break;
            
            case '3':
                if($request->getUri()->getSegment(1)!='Penjual'){
                    return redirect()->to(base_url('Penjual/Order'));
                }
                break;
            
            case '4':
                if($request->getUri()->getSegment(1)!='Pembeli'){
                    return redirect()->to(base_url('Pembeli/Order'));
                }
                break;
            
            default:
                break;
        }
        
        // return redirect()->to(base_url('Admin/Home/index'));
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        // dd($request->getPath());
    }
}