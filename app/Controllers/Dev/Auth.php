<?php

namespace App\Controllers\Dev;
use App\Controllers\BaseController;
use App\Models\DevUserModel;
use CodeIgniter\API\ResponseTrait;
use Google_Client;
use Google_Service;
use Google_Service_Oauth2;

class Auth extends BaseController
{
    use ResponseTrait;
    protected $dev_user_model = null;

    public function __construct()
    {
        $this->dev_user_model = new DevUserModel();
    }

    public function login()
    {
        $client = new Google_Client();
        $clientId = '702230385588-0f2bsrk8nh8094o08lsdq1t3kteljh0a.apps.googleusercontent.com';
        $clientSecret = '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';
        $redirectUri = base_url('Dev/Auth/login');

        $client->setClientId($clientId);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $client->addScope('profile');
        $client->addScope('email');

        if(isset($_GET['code'])){
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token['access_token']);
            $service = new Google_Service_Oauth2($client);
        }else{
            return redirect()->to($client->createAuthUrl());
        }
        // $data = $service->user_info->get();
        $user = [
            'name' => $service->userinfo->get()->getName(),
            'email' => $service->userinfo->get()->getEmail(),
            'role' => 1
        ];
        $user_local = $this->dev_user_model->where('email' , $user['email'])->get()->getRowArray();
        if(!$user_local){
            $this->dev_user_model->insert($user);
        }
        $user_local = $this->dev_user_model->where('email' , $user['email'])->get()->getRowArray();

        session()->set('dev_user_id' , $user_local['id']);
        session()->set('dev_user_name' , $user_local['name']);
        session()->set('dev_user_email' , $user_local['email']);
        session()->set('dev_user_role' , $user_local['role']);

        session()->set('dev_log' , true);
        return redirect()->to(base_url('Dev/Dashboard/index'));
        
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('Dev/Documentation'));
    }
}

