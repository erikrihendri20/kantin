<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\RoleModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class User extends BaseController
{
    use ResponseTrait;
    protected $user_model = null;
    protected $role_model = null;

    public function __construct()
    {
        session();
        $this->user_model = new UserModel();
        $this->role_model = new RoleModel();
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
            'styles' => 'admin/user',
            'scripts' => 'admin/user'
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
            'styles' => 'admin/insert',
            'scripts' => 'admin/insert',
            'role' => $this->role_model->findAll()
            
        ];
        if (isset($_POST['submit'])) {
            $rules = [
                'name' => [
                    'rules' => 'required|alpha_space',
                    'errors' => [
                        'required' => 'Nama harus diisi',
                        'alpha_space' => 'Nama hanya boleh berisi huruf'
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
            'styles' => 'admin/edit',
            'scripts' => 'admin/edit',
            'role' => $this->role_model->findAll(),
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
            $this->user_model->set('role' , $this->request->getPost('role'))->where('id' , $id)->update();
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
        if($user){
            $this->user_model->delete($user_id);
            return $this->respond($user);
        }else{
            return $this->fail('pengguna tidak ditemukan' , 400);
        };
    }

    public function getUsers()
    {
        return $this->respond($this->user_model->select('users.id as id , users.name as name, users.email as email, role.name as role')->join('role' , 'users.role=role.id')->get()->getResultArray());
    }

    public function saldoPengguna()
    {
        
    }



}
