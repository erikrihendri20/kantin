<?php

namespace App\Controllers\Penjual;
use App\Controllers\BaseController;

class Pesanan extends BaseController
{
    public function index()
    {
        $data = [
            'header_title' => 'Daftar Pesanan | Kantin STIS',
            'active' => 'Daftar Pesanan',
            'nav' => [
                [
                    'title' => 'Daftar Pesanan',
                    'url' => 'Penjual/Pesanan'
                ],
            ],
            'plugins' => [],
            'styles' => 'penjual/pesanan/index',
            'scripts' => 'penjual/pesanan/index'
        ];
        return view('penjual/pesanan/index' , $data);  
    }
}
