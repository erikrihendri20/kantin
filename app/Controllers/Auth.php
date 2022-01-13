<?php

namespace App\Controllers;

use App\Models\UserModel;
use Google_Client;
use Google_Service;
use Google_Service_Oauth2;

class Auth extends BaseController
{

    protected $user_model = null;    

    public function __construct()
    {
        session();
        $this->user_model = new UserModel();
    }

    public function login_sso()
    {
        
        $client = new Google_Client();
        $clientId = '702230385588-4d4icl772oc8k5iojnstmng2d4cjr92t.apps.googleusercontent.com';
        $clientSecret = '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';
        $redirectUri = base_url('Auth/login_sso');

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
            'role' =>  4,
            'photo' => $service->userinfo->get()->getPicture(),
            'type_login' => 'sso',
        ];
        $user_local = $this->user_model->where('email' , $user['email'])->get()->getRowArray();
        if(!$user_local){
            $this->user_model->insert($user);
        }

        if($user_local['type_login']!='sso'){
            session()->destroy();
            session();
            $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Email sudah digunakan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);
            return redirect()->to(base_url('auth/login'));
        }else{

        }
        $user_local = $this->user_model->where('email' , $user['email'])->get()->getRowArray();

        session()->set($user_local);

        session()->set('log' , true);
        switch ($user['role']) {
            case '1':
                return redirect()->to(base_url('Admin/Home'));
                break;

            case '2':
                return redirect()->to(base_url('Admin/Home'));
                break;
            
            case '3':
                return redirect()->to(base_url('Penjual/Order'));
                break;
            
            case '4':
                return redirect()->to(base_url('Pembeli/Order'));
                break;
            
            default:
                # code...
                break;
        }
    }

    public function registrasi()
    {
        $this->user_model->save([
            'name' => 'erik',
            'email' => 'akun2@gmail.com',
            'password' => password_hash('erca2005' , PASSWORD_DEFAULT),
            'role' => 4,
            'photo' => 'default.png'
        ]);
    }

    public function login()
    {
        $data = [
            'header_title' => 'Login | Kantin STIS',
            'page_title' => 'Login',
            'url' => 'login'
        ];

        if(isset($_POST['submit'])){
            $rules = [
                'email' => 'required',
                'password' => 'required',
            ];

            if(!$this->validate($rules)){
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
									Isikan salah!
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>';
			    $flash = session()->setFlashdata('flash', $flash);
                return redirect()->to(base_url('auth/login'));
            }
            $user = $this->user_model->where('email' , $this->request->getPost('email'))->where('type_login' , 'none')->get()->getRowArray();
            if(!$user){
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Pengguna tidak ditemukan!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->to(base_url('auth/login'));
            }
            if(!password_verify($this->request->getPost('password') , $user['password'])){
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Password Salah!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->to(base_url('auth/login'));
            }
            session()->set($user);
            session()->set('log' , true);

            switch ($user['role']) {
                case '1':
                    return redirect()->to(base_url('Admin/Home'));
                    break;

                case '2':
                    return redirect()->to(base_url('Admin/Home'));
                    break;
                
                case '3':
                    return redirect()->to(base_url('Penjual/Order'));
                    break;
                
                case '4':
                    return redirect()->to(base_url('Pembeli/Order'));
                    break;
                
                default:
                    # code...
                    break;
            }
        }



        return view('auth/login' , $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('Auth/login'));
    }


}
