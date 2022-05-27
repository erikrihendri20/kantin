<?php

namespace App\Controllers\Penjual;
use App\Controllers\BaseController;
use App\Models\UserLogModel;
use CodeIgniter\API\ResponseTrait;

class Info extends BaseController
{
    use ResponseTrait;
    protected $user_log_model = null;


    public function __construct()
    {
        $this->user_log_model = new UserLogModel();
    }

    public function index()
    {
        $data = [
            'header_title' => 'Informasi | Kantin STIS',
            'active' => 'Info',
            'nav' => [
                [
                    'title' => 'Informasi',
                    'url' => 'Penjual/Info'
                ],
            ],
            'plugins' => [],
            'styles' => 'penjual/info/index',
            'visitor' => count($this->user_log_model->getVisitor()),
            'scripts' => 'penjual/info/index'
        ];
        return view('penjual/info/index' , $data);  
    }
}

