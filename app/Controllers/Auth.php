<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{

    protected $user_model = null;

    public function __construct()
    {
        session();
        $this->user_model = new UserModel();
    }

    public function registrasi()
    {
        $this->user_model->save([
            'name' => 'erik',
            'email' => '221810270@gmail.com',
            'password' => password_hash('erca2005' , PASSWORD_DEFAULT),
            'role' => 3,
            'photo' => 'default'
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
            $user = $this->user_model->where('email' , $this->request->getPost('email'))->get()->getRowArray();
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
                    return redirect()->to(base_url('Penjual/Pesanan'));
                    break;
                
                case '4':
                    return redirect()->to(base_url('Pembeli/Pesan'));
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
