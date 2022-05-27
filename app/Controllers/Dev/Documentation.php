<?php

namespace App\Controllers\Dev;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Documentation extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
    }

    public function index()
    {
        $data = [
            'header_title' => 'Documentation',
            'active' => 'Documentation',
            'nav' => [
                [
                    'title' => 'Documentation',
                    'url' => 'Dev/documentation'
                ],
            ],
            'plugins' => [],
            'styles' => 'dev/documentation/index',
            'scripts' => 'dev/documentation/index'
        ];
        return view('dev/documentation/index' , $data);  
    }

    
}

