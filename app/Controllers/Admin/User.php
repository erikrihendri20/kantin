<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\RoleModel;
use App\Models\UserLogModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\DevUserModel;
use App\Models\DevApiModel;

class User extends BaseController
{
    use ResponseTrait;
    protected $user_model = null;
    protected $role_model = null;
    protected $user_log_model = null;
    protected $dev_user_model = null;
    protected $dev_api_model = null;

    public function __construct()
    {
        session();
        $this->user_model = new UserModel();
        $this->role_model = new RoleModel();
        $this->user_log_model = new UserLogModel();
        $this->dev_user_model = new DevUserModel();
        $this->dev_api_model = new DevApiModel();
    }

    public function index()
    {
        $data = [
            'header_title' => 'Daftar Pengguna | Kantin STIS',
            'active' => 'Daftar Pengguna',
            'nav' => [
                [
                    'title' => 'Daftar Pengguna',
                    'url' => 'Admin/User'
                ],
            ],
            'plugins' => [
                'datatable'
            ],
            'styles' => 'admin/user/index',
            'visitor' => count($this->user_log_model->getVisitor()),
            'scripts' => 'admin/user/index'
        ];
        return view('admin/user/index' , $data);  
    }

    public function insert()
    {
        $data = [
            'header_title' => 'Tambah Pengguna | Kantin STIS',
            'active' => 'Daftar Pengguna',
            'nav' => [
                [
                    'title' => 'Daftar Pengguna',
                    'url' => 'Admin/User'
                ],
                [
                    'title' => 'Tambah Pengguna',
                    'url' => 'Admin/User/insert'
                ],
            ],
            'plugins' => [],
            'styles' => 'admin/user/insert',
            'visitor' => count($this->user_log_model->getVisitor()),
            'scripts' => 'admin/user/insert',
            'role' => (session()->role==1) ? $this->role_model->findAll() : $this->role_model->whereIn('id' , [3,4])->get()->getResultArray(),
            
        ];
        if (isset($_POST['submit'])) {
            $rules = [
                'name' => [
                    'rules' => 'required|alpha_space',
                    'errors' => [
                        'required' => 'Nama harus diisi!',
                        'alpha_space' => 'Nama hanya boleh berisi huruf!'
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_emails|is_unique[users.email]',
                    'errors' => [
                        'required' => 'Email harus diisi',
                        'valid_emails' => 'Format email tidak tepat',
                        'is_unique' => 'Email sudah terdaftar'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => 'Password harus diisi',
                        'min_length' => 'Password minimal terdiri dari 8 karakter'
                    ]
                ],
                'konfirmasi_password' => [
                    'rules' => 'matches[password]',
                    'errors' => [
                        'matches' => 'konfirmasi password tidak sesuai'
                    ]
                ],
                'role' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role harus diisi'
                    ]
                ],
            ];
            if(!$this->validate($rules)){
                $alert = [
                    'Gagal!',
                    'gagal menambahkan user',
                    'warning'
                ];
                session()->setFlashdata('flash' , implode('|' , $alert));
                return redirect()->back()->withInput();
            }
            $user_role = session()->role;
            if($user_role != 1){
                if($this->request->getPost('role') == 1){
                    $alert = [
                        'Gagal!',
                        'Anda tidak memiliki hak untuk menambahkan pengguna super admin',
                        'warning'
                    ];
                    session()->setFlashdata('flash' , implode('|' , $alert));
                    return redirect()->back()->withInput();
                }elseif($this->request->getPost('role') == 2){
                    $alert = [
                        'Gagal!',
                        'Anda tidak memiliki hak untuk menambahkan pengguna admin',
                        'warning'
                    ];
                    session()->setFlashdata('flash' , implode('|' , $alert));
                    return redirect()->back()->withInput();
                }   
            }
            $user = $this->user_model->insert([
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
                'role' => $this->request->getPost('role'),
                'photo' => 'default',
            ]);
            $user = $this->user_model->find($user);
            $alert = [
                'Berhasil!',
                $user['name'] . ' berhasil ditambahkan.',
                'success'
            ];
            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Admin/User'))->withInput();
        }
        return view('admin/user/insert' , $data);
    }

    public function edit($id=null)
    {
        if(!$id){
            $alert = [
                'Gagal!',
                'user tidak ditemukan',
                'warning'
            ];
            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Admin/User'));
        }
        $data = [
            'header_title' => 'Edit Pengguna | Kantin STIS',
            'active' => 'Daftar Pengguna',
            'nav' => [
                [
                    'title' => 'Daftar Pengguna',
                    'url' => 'Admin/User'
                ],
                [
                    'title' => 'Edit Pengguna',
                    'url' => 'Admin/User/edit'
                ],
            ],
            'plugins' => [],
            'styles' => 'admin/user/edit',
            'visitor' => count($this->user_log_model->getVisitor()),
            'scripts' => 'admin/user/edit',
            'role' => (session()->role==1) ? $this->role_model->findAll() : $this->role_model->whereIn('id' , [3,4])->get()->getResultArray(),
            'user' => $this->user_model->find($id)
        ];

        if(isset($_POST['submit'])){
            $rules = [
                'role' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'role tidak boleh kosong'
                    ]
                ]
            ];
            if(!$this->validate($rules)){
                $alert = [
                    'Gagal!',
                    'kesalahan pengisian form.',
                    'warning'
                ];
                session()->setFlashdata('flash' , implode('|' , $alert));
                return redirect()->back()->withInput();
            }
            $user_role = session()->role;
            if($user_role != 1){
                if($this->request->getPost('role') == 1){
                    $alert = [
                        'Gagal!',
                        'Anda tidak memiliki hak untuk mengubah pengguna super admin',
                        'warning'
                    ];
                    session()->setFlashdata('flash' , implode('|' , $alert));
                    return redirect()->back()->withInput();
                }elseif($this->request->getPost('role') == 2){
                    $alert = [
                        'Gagal!',
                        'Anda tidak memiliki hak untuk mengubah pengguna admin',
                        'warning'
                    ];
                    session()->setFlashdata('flash' , implode('|' , $alert));
                    return redirect()->back()->withInput();
                }   
            }
            $this->user_model->set('role' , $this->request->getPost('role'))->set('status',$this->request->getPost('status'))->where('id' , $id)->update();
            // $user = $this->user_model->find($id);
            $alert = [
                'Berhasil!',
                'Data berhasil di perbarui',
                'success'
            ];
            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Admin/User'))->withInput();
        }

        return view('admin/user/edit' , $data);
    }

    public function delete($user_id=null)
    {
        if(!$user_id){
            return $this->fail('pengguna tidak ditemukan' , 400);
        }
        $user = $this->user_model->find($user_id);
        $user_role = session()->role;
        if($user_role != 1){
            if($user['role'] == 1){
                return $this->fail('Anda tidak memiliki hak untuk menghapus pengguna super admin' , 400);
            }elseif($user['role'] == 2){
                return $this->fail('Anda tidak memiliki hak untuk menghapus pengguna admin' , 400);
            }
        }
        if($user){
            $this->user_model->delete($user_id);
            return $this->respond($user);
        }else{
            return $this->fail('pengguna tidak ditemukan' , 400);
        };
    }

    public function getUsers()
    {
        $user = session()->id;
        if($user==1){
            return $this->respond($this->user_model->select('users.id as id , users.name as name, users.email as email, role.name as role , status')->join('role' , 'users.role=role.id')->get()->getResultArray());
        }else{
            return $this->respond($this->user_model->select('users.id as id , users.name as name, users.email as email, role.name as role , status')->join('role' , 'users.role=role.id')->whereIn('users.role' , [3,4])->get()->getResultArray());
        }
    }

    public function devUser()
    {
        if(session()->role!=1){
            return redirect()->to(base_url('Admin/Dashboard'));
        }
        $data = [
            'header_title' => 'Daftar Pengguna Dev | Kantin STIS',
            'active' => 'Daftar Pengguna Dev',
            'nav' => [
                [
                    'title' => 'Daftar Pengguna Dev',
                    'url' => 'Admin/User/devUser'
                ],
            ],
            'plugins' => [
                'datatable'
            ],
            'styles' => 'admin/user/devUser',
            'visitor' => count($this->user_log_model->getVisitor()),
            'scripts' => 'admin/user/devUser',
            'users' => $this->dev_user_model->findAll()
        ];
        return view('admin/user/devUser' , $data);
    }

    public function deleteDevUser($id)
    {
        if(session()->role!=1){
            $alert = [
                'Gagal!',
                'Anda tidak memiliki hak untuk menghapus pengguna dev',
                'warning'
            ];
            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Admin/User/devUser'))->withInput();
        }
        if(!$id){
            $alert = [
                'Gagal!',
                'pengguna tidak ditemukan',
                'warning'
            ];
            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Admin/User/devUser'))->withInput();
        }
        $user = $this->dev_user_model->find($id);
        if(!$user){
            $alert = [
                'Gagal!',
                'pengguna tidak ditemukan',
                'warning'
            ];
            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Admin/User/devUser'))->withInput();
        }
        $this->dev_user_model->delete($id);
        $alert = [
            'Berhasil!',
            'Data berhasil di hapus',
            'success'
        ];
        session()->setFlashdata('flash' , implode('|' , $alert));
        return redirect()->to(base_url('Admin/User/devUser'))->withInput();

    }

    public function editDevUser($id)
    {
        if(session()->role!=1){
            $alert = [
                'Gagal!',
                'Anda tidak memiliki hak untuk mengubah pengguna dev',
                'warning'
            ];
            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Admin/User/devUser'))->withInput();
        }
        if(!$id){
            $alert = [
                'Gagal!',
                'Parameter tidak sesuai',
                'warning'
            ];
            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Admin/User/devUser'))->withInput();
        }
        $user = $this->dev_user_model->find($id);
        if(!$user){
            $alert = [
                'Gagal!',
                'pengguna tidak ditemukan',
                'warning'
            ];
            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Admin/User/devUser'))->withInput();
        }
        $rules = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Email tidak valid'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role tidak boleh kosong'
                ]
            ],
        ];
        if(!$this->validate($rules)){
            $alert = [
                'Gagal!',
                'Data tidak valid',
                'warning'
            ];
            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Admin/User/devUser'))->withInput();
        }
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
        ];
        $this->dev_user_model->update($id , $data);
        $alert = [
            'Berhasil!',
            'Data berhasil di ubah',
            'success'
        ];
        session()->setFlashdata('flash' , implode('|' , $alert));
        return redirect()->to(base_url('Admin/User/devUser'))->withInput();
    }

    public function insertDevUser()
    {
        if(session()->role!=1){
            $alert = [
                'Gagal!',
                'Anda tidak memiliki hak untuk menambah pengguna dev',
                'warning'
            ];
            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Admin/User/devUser'))->withInput();
        }
        $rules = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Email tidak valid'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role tidak boleh kosong'
                ]
            ],
        ];
        if(!$this->validate($rules)){
            $alert = [
                'Gagal!',
                'Data tidak valid',
                'warning'
            ];
            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Admin/User/devUser'))->withInput();
        }
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
        ];
        $this->dev_user_model->insert($data);
        $alert = [
            'Berhasil!',
            'Data berhasil di tambah',
            'success'
        ];
        session()->setFlashdata('flash' , implode('|' , $alert));
        return redirect()->to(base_url('Admin/User/devUser'))->withInput();
    }

    public function devApi($dev_user_id=null)
    {
        if(session()->role!=1){
            return redirect()->to(base_url('Admin/Dashboard'));
        }
        if($dev_user_id==null){
            $api = $this->dev_api_model
            ->join('dev_users' , 'dev_users.id = dev_api.dev_user_id')
            ->select('dev_api.* , dev_users.name , dev_users.email')
            ->get()->getResultArray();
        }else{
            $api = $this->dev_api_model
            ->join('dev_users' , 'dev_users.id = dev_api.dev_user_id')
            ->select('dev_api.* , dev_users.name , dev_users.email')
            ->where('dev_api.dev_user_id' , $dev_user_id)
            ->get()->getResultArray();
        }
        $data = [
            'header_title' => 'Daftar Api Dev | Kantin STIS',
            'active' => 'Dev Api',
            'nav' => [
                [
                    'title' => 'Daftar Api Dev',
                    'url' => 'Admin/User/devApi'
                ],
            ],
            'plugins' => [
                'datatable'
            ],
            'styles' => 'admin/user/devApi',
            'visitor' => count($this->user_log_model->getVisitor()),
            'scripts' => 'admin/user/devApi',
            'api' => $api,
        ];
        return view('admin/user/devApi' , $data);
    }

    public function editApiKey($id)
    {
        $dev_user_id = $this->request->getPost('dev_user_id');
        $rules = [
            'application_name' => 'required|min_length[3]|max_length[50]',
            'application_type' => 'required',
            'url' => 'required|min_length[3]',
            'information' => 'required|min_length[3]',
            'status' => 'required',
        ];

        if(!$this->validate($rules)){
            $alert = [
                'Gagal!',
                'gagal mengubah api',
                'warning'
            ];
            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Admin/User/devApi/'.$dev_user_id))->withInput();
        }

        $data = [
            'application_name' => $this->request->getPost('application_name'),
            'application_type' => $this->request->getPost('application_type'),
            'url' => $this->request->getPost('url'),
            'information' => $this->request->getPost('information'),
            'status' => $this->request->getPost('status'),
        ];

        $this->dev_api_model->update($id , $data);
        $alert = [
            'Sukses!',
            'berhasil mengubah api',
            'success'
        ];
        session()->setFlashdata('flash' , implode('|' , $alert));
        return redirect()->to(base_url('Admin/User/devApi/'.$dev_user_id))->withInput();
    }

    public function deleteApiKey($id)
    {
        $dev_user_id = $this->request->getGet('dev_user_id');
        $this->dev_api_model->delete($id);
        $alert = [
            'Sukses!',
            'berhasil menghapus api',
            'success'
        ];
        session()->setFlashdata('flash' , implode('|' , $alert));
        return redirect()->to(base_url('Admin/User/devApi/'.$dev_user_id))->withInput();
    }

}
