<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\UserModel;

class Home extends BaseController
{
    public function index()
    {
        $user_model = new UserModel();
        $data = [
            'header_title' => 'Home | Kantin STIS',
            'active' => 'Home',
            'nav' => [
                [
                    'title' => 'Home',
                    'url' => 'Admin/Home'
                ],
            ],
            'plugins' => [],
            'styles' => 'admin/home/index',
            'scripts' => 'admin/home/index',
            'users' => $user_model->findAll()
        ];
        return view('admin/home/index' , $data);  
    }
}
