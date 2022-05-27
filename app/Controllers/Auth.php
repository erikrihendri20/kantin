<?php

namespace App\Controllers;

use App\Models\UserLogModel;
use App\Models\UserModel;
use Google_Client;
use Google_Service;
use Google_Service_Oauth2;

class Auth extends BaseController
{

    protected $user_model = null;    
    protected $user_log_model = null;

    public function __construct()
    {
        session();
        $this->user_model = new UserModel();
        $this->user_log_model = new UserLogModel();
        date_default_timezone_set('Asia/Jakarta');
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
        $user_local = $this->user_model->where('email' , $user['email'])->get()->getRowArray();
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
        
        if($user_local['status']==0){
            $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Anda diblokir karena melakukan pelanggaran!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
            $flash = session()->setFlashdata('flash', $flash);
            return redirect()->to(base_url('auth/login'));
        }

        $this->user_log_model->insert([
            'user_id' => $user_local['id']
        ]);
        session()->set($user_local);

        session()->set('log' , true);
        switch ($user['role']) {
            case '1':
                return redirect()->to(base_url('Admin/Dashboard'));
                break;

            case '2':
                return redirect()->to(base_url('Admin/Dashboard'));
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

    public function profile()
    {
        session();
        $user_id = session()->get('id');
        if(isset($_POST['submit'])){
            $rules = [
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama makanan harus diisi'
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email harus diisi',
                        'valid_email' => 'Email tidak valid'
                    ]
                ],
                'old-password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password lama harus diisi'
                    ]
                ],
                'confirm-password' => [
                    'rules' => 'matches[new-password]',
                    'errors' => [
                        'matches' => 'Password baru tidak sama'
                    ]
                ],
                'photo' => [
                    'rules' => 'mime_in[photo,image/jpg,image/jpeg,image/png]|max_size[photo,1000]',
                    'errors' => [
                        'mime_in' => 'gunakan ekstensi jpg,png,jpeg',
                        'max_size' => 'ukuran gambar maksimal 1 mb'
                    ]
                ]
            ];
            if(!$this->validate($rules)){
                $alert = [
                    'Gagal!',
                    'gagal menambahkan mengubah profil',
                    'warning'
                ];
                session()->setFlashdata('flash' , implode('|' , $alert));
                return redirect()->back()->withInput();
            }
            $user = $this->user_model->find($user_id);
            if(password_verify($this->request->getPost("old-password"), $user['password'])){
                $data = [
                    'name' => $this->request->getPost("name"),
                ];
                if($this->request->getPost("new-password")!=''){
                    $data['password'] = password_hash($this->request->getPost("new-password"), PASSWORD_DEFAULT);
                }
                try {
                    if($this->request->getFile('photo')){
                        $file = $this->request->getFile('photo');
                        $file->move('assets/img/user/' , $file->getName());
                        $data['photo'] = $file->getName();
                    }
                    //code...
                } catch (\Throwable $th) {
                    //throw $th;
                }
                $this->user_model->update($user_id, $data);
                $alert = [
                    'Berhasil!',
                    'Berhasil mengubah profil',
                    'success'
                ];
                session()->setFlashdata('flash' , implode('|' , $alert));
                return redirect()->to(base_url('Pembeli/Order'));
            }
            $alert = [
                'Gagal!',
                'Password lama tidak sesuai',
                'warning'
            ];
            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->back();
        }

        $data = [
            'header_title' => 'profile | Kantin STIS',
            'active' => 'Profile',
            'nav' => [
                [
                    'title' => 'Profile',
                    'url' => 'Auth/profile',
                ],
            ],
            'plugins' => [],
            'styles' => 'auth/profile',
            'scripts' => 'auth/profile',
            'visitor' => count($this->user_log_model->getVisitor()),
            'user' => $this->user_model->find($user_id),
        ];
        return view('auth/profile' , $data);  
    }

    public function registrasi()
    {
        // $this->user_model->save([
        //     'name' => 'super admin',
        //     'email' => 'superadmin@gmail.com',
        //     'password' => password_hash('erca2005' , PASSWORD_DEFAULT),
        //     'role' => 1,
        //     'photo' => 'default.png'
        // ]);
        // $this->user_model->save([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => password_hash('erca2005' , PASSWORD_DEFAULT),
        //     'role' => 2,
        //     'photo' => 'default.png'
        // ]);
        // $this->user_model->save([
        //     'name' => 'penjual satu',
        //     'email' => 'penjual1@gmail.com',
        //     'password' => password_hash('erca2005' , PASSWORD_DEFAULT),
        //     'role' => 3,
        //     'photo' => 'default.png'
        // ]);
        // $this->user_model->save([
        //     'name' => 'penjual dua',
        //     'email' => 'penjual2@gmail.com',
        //     'password' => password_hash('erca2005' , PASSWORD_DEFAULT),
        //     'role' => 3,
        //     'photo' => 'default.png'
        // ]);
        // $this->user_model->save([
        //     'name' => 'penjual tiga',
        //     'email' => 'penjual3@gmail.com',
        //     'password' => password_hash('erca2005' , PASSWORD_DEFAULT),
        //     'role' => 3,
        //     'photo' => 'default.png'
        // ]);
        // $this->user_model->save([
        //     'name' => 'penjual empat',
        //     'email' => 'penjual4@gmail.com',
        //     'password' => password_hash('erca2005' , PASSWORD_DEFAULT),
        //     'role' => 3,
        //     'photo' => 'default.png'
        // ]);
        // $this->user_model->save([
        //     'name' => 'penjual lima',
        //     'email' => 'penjual5@gmail.com',
        //     'password' => password_hash('erca2005' , PASSWORD_DEFAULT),
        //     'role' => 3,
        //     'photo' => 'default.png'
        // ]);
        // $this->user_model->save([
        //     'name' => 'penjual enam',
        //     'email' => 'penjual6@gmail.com',
        //     'password' => password_hash('erca2005' , PASSWORD_DEFAULT),
        //     'role' => 3,
        //     'photo' => 'default.png'
        // ]);
        for ($i=1; $i < 501; $i++) {
            $this->user_model->save([
                'name' => 'pembeli'.$i,
                'email' => 'pembeli'.$i.'@gmail.com',
                'password' => password_hash('erca2005' , PASSWORD_DEFAULT),
                'role' => 4,
                'photo' => 'default.png'
            ]);
        }
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
            if($user['status']==0){
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Anda diblokir karena melakukan pelanggaran!
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

            $this->user_log_model->insert([
                'user_id' => $user['id'],
            ]);
            session()->set($user);
            session()->set('log' , true);

            switch ($user['role']) {
                case '1':
                    return redirect()->to(base_url('Admin/Dashboard'));
                    break;

                case '2':
                    return redirect()->to(base_url('Admin/Dashboard'));
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
