<?php

namespace App\Controllers\Penjual;
use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\MenuTypeModel;
use App\Models\TopingModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class Menu extends BaseController
{
    use ResponseTrait;
    protected $menu_model = null;
    protected $toping_model = null;
    protected $user_model = null;
    protected $menu_type_model = null;

    public function __construct()
    {
        session();
        $this->menu_model = new MenuModel();
        $this->toping_model = new TopingModel();
        $this->menu_type_model = new MenuTypeModel();
        $this->user_model = new UserModel();
    }

    public function index()
    {
        $data = [
            'header_title' => 'Menu Makanan | Kantin STIS',
            'active' => 'Daftar Menu',
            'nav' => [
                [
                    'title' => 'Daftar Menu',
                    'url' => 'Penjual/Menu'
                ],
            ],
            'plugins' => [],
            'styles' => 'penjual/menu/index',
            'scripts' => 'penjual/menu/index'
        ];
        return view('penjual/menu/index' , $data);  
    }

    public function getMenu()
    {
        $keyword = $this->request->getGet('keyword');
        $limit = $this->request->getGet('limit');
        $indeks = $this->request->getGet('indeks');
        return $this->respond($this->menu_model->getMenu(session()->id,$keyword,$limit,$indeks));
    }
    public function getPaginMenu()
    {
        $keyword = $this->request->getGet('keyword');
        
        return $this->respond($this->menu_model->getPaginMenu(session()->id,$keyword));
    }



    public function getToping($menu_id)
    {
        if($menu_id){
            return $this->respond($this->toping_model->where('menu_id' , $menu_id)->get()->getResultArray());
        }
        return $this->respond([]);
    }

    public function insert()
    {
        $data = [
            'header_title' => 'Tambah Menu | Kantin STIS',
            'active' => 'Daftar Menu',
            'nav' => [
                [
                    'title' => 'Daftar Menu',
                    'url' => 'Penjual/Menu'
                ],
                [
                    'title' => 'Tambah Menu',
                    'url' => 'Penjual/Menu/insert'
                ],
            ],
            'plugins' => [],
            'styles' => 'penjual/menu/insert',
            'scripts' => 'penjual/menu/insert',
            'menu_types' => $this->menu_type_model->findAll()
        ];

        if (isset($_POST['submit'])) {
            $rules = [
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama makanan harus diisi'
                    ]
                ],
                'type' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Email harus diisi'
                    ]
                ],
                'price' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'harga harus diisi'
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
                    'gagal menambahkan menu makanan',
                    'warning'
                ];
                session()->setFlashdata('flash' , implode('|' , $alert));
                return redirect()->back()->withInput();
            }

            $photo = $this->request->getFile('photo');
            
            $menu = [
                'user_id' => session()->id,
                'name' => $this->request->getPost('name'),
                'type' => $this->request->getPost('type'),
                'price' => $this->request->getPost('price'),
                'description' => $this->request->getPost('description'),
            ];
            if($photo->isValid()){
                $menu['photo'] = $photo->getRandomName();
                $photo->move('./assets/img/menu', $menu['photo']);
            }else{
                $menu['photo'] = 'default.png';
            }

            $menu = $this->menu_model->insert($menu);

            $alert = [
                'Berhasil!',
                'berhasil ditambahkan.',
                'success'
            ];

            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Penjual/Menu/insertToping/'.$menu));
        }
        return view('penjual/menu/insert' , $data);  
    }

    public function detail($menu_id)
    {
        if(!$menu_id){
            $alert = [
                'Gagal!',
                'menu tidak ditemukan.',
                'warning'
            ];

            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Penjual/Menu'));
        }
        $data = [
            'header_title' => 'Detail Menu | Kantin STIS',
            'active' => 'Daftar Menu',
            'nav' => [
                [
                    'title' => 'Daftar Menu',
                    'url' => 'Penjual/Menu'
                ],
                [
                    'title' => 'Detail Menu',
                    'url' => 'Penjual/Menu/detail'
                ],
            ],
            'plugins' => [],
            'styles' => 'penjual/menu/detail',
            'scripts' => 'penjual/menu/detail',
            'menu' => $this->menu_model->find($menu_id),
            'penjual' => $this->user_model->find(session()->id),
        ];
        $data['type'] = $this->menu_type_model->find($data['menu']['type']);
        return view('penjual/menu/detail' , $data);
    }

    public function delete($menu_id=null)
    {
        if(!$menu_id){
            return $this->fail('menu tidak ditemukan' , 400);
        }
        $menu = $this->menu_model->find($menu_id);
        if($menu){
            if($menu['photo']!='default.png'){
                $photo = "./assets/img/menu/" . $menu['photo'];
                unlink($photo);
            }
            $this->menu_model->delete($menu_id);
            $this->toping_model->where('menu_id' , $menu_id)->delete();
            return $this->respond($menu);
        }else{
            return $this->fail('menu tidak ditemukan' , 400);
        };
    }

    public function edit($menu_id)
    {
        if(!($menu_id)){
            $alert = [
                'Gagal!',
                'menu tidak ditemukan.',
                'warning'
            ];

            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Penjual/Menu'));
        }
        $data = [
            'header_title' => 'Edit Menu | Kantin STIS',
            'active' => 'Daftar Menu',
            'nav' => [
                [
                    'title' => 'Daftar Menu',
                    'url' => 'Penjual/Menu'
                ],
                [
                    'title' => 'Edit Menu',
                    'url' => 'Penjual/Menu/edit/' . $menu_id
                ],
            ],
            'plugins' => [],
            'styles' => 'penjual/menu/edit',
            'scripts' => 'penjual/menu/edit',
            'menu_types' => $this->menu_type_model->findAll(),
            'menu' => $this->menu_model->find($menu_id),
        ];
        if (isset($_POST['submit'])) {
            $rules = [
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama makanan harus diisi'
                    ]
                ],
                'type' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Email harus diisi'
                    ]
                ],
                'price' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'harga harus diisi'
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
                    'gagal mengubah menu',
                    'warning'
                ];
                session()->setFlashdata('flash' , implode('|' , $alert));
                return redirect()->back()->withInput();
            }
            
            $photo = $this->request->getFile('photo');
            if($photo->isValid()){
                $old_photo = "./assets/img/menu/" . $data['menu']['photo'];
                unlink($old_photo);
                $menu['photo'] = $photo->getRandomName();
                $photo->move('./assets/img/menu', $menu['photo']);
                $this->menu_model
                ->set('name' , $this->request->getPost('name'))
                ->set('type' , $this->request->getPost('type'))
                ->set('price' , $this->request->getPost('price'))
                ->set('description' , $this->request->getPost('description'))
                ->set('photo' , $menu['photo'])
                ->where('id' , $menu_id)
                ->update();
                
            }else{
                $this->menu_model
                ->set('name' , $this->request->getPost('name'))
                ->set('type' , $this->request->getPost('type'))
                ->set('price' , $this->request->getPost('price'))
                ->set('description' , $this->request->getPost('description'))
                ->where('id' , $menu_id)
                ->update();
            }

            $alert = [
                'Berhasil!',
                'menu berhasil diubah.',
                'success'
            ];

            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Penjual/Menu/'));

        }
        return view('penjual/menu/edit' , $data);
    }

    public function insertToping($menu_id)
    {
        if(!$menu_id){
            $alert = [
                'Gagal!',
                'menu tidak ditemukan.',
                'warning'
            ];

            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Penjual/Menu'));
        }
        $data = [
            'header_title' => 'Tambah Toping | Kantin STIS',
            'active' => 'Daftar Menu',
            'nav' => [
                [
                    'title' => 'Daftar Menu',
                    'url' => 'Penjual/Menu'
                ],
                [
                    'title' => 'Detail Menu',
                    'url' => 'Penjual/Menu/detail/' . $menu_id
                ],
                [
                    'title' => 'Tambah Toping',
                    'url' => 'Penjual/Menu/insertToping/' . $menu_id
                ],
            ],
            'plugins' => [],
            'styles' => 'penjual/menu/insert-toping',
            'scripts' => 'penjual/menu/insert-toping'
        ];
        
        if(isset($_POST['submit'])){
            $rules = [
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama makanan harus diisi'
                    ]
                ],
                'price' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'harga harus diisi'
                    ]
                ],
            ];
            if(!$this->validate($rules)){
                $alert = [
                    'Gagal!',
                    'gagal menambahkan menu makanan',
                    'warning'
                ];
                session()->setFlashdata('flash' , implode('|' , $alert));
                return redirect()->back()->withInput();
            }
            $toping = [
                'menu_id' => $menu_id,
                'name' => $this->request->getPost('name'),
                'price' => $this->request->getPost('price'),
            ];
            $this->toping_model->insert($toping);

            $alert = [
                'Berhasil!',
                'berhasil ditambahkan.',
                'success'
            ];

            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Penjual/Menu/insertToping/'.$menu_id));
        }
        return view('penjual/menu/insert-toping' , $data);  
    }

    public function editToping($menu_id , $toping_id)
    {
        if(!($toping_id&&$menu_id)){
            $alert = [
                'Gagal!',
                'menu tidak ditemukan.',
                'warning'
            ];

            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Penjual/Menu'));
        }
        $data = [
            'header_title' => 'Edit Toping | Kantin STIS',
            'active' => 'Daftar Menu',
            'nav' => [
                [
                    'title' => 'Daftar Menu',
                    'url' => 'Penjual/Menu'
                ],
                [
                    'title' => 'Detail Menu',
                    'url' => 'Penjual/Menu/detail/' . $menu_id
                ],
                [
                    'title' => 'Edit Toping',
                    'url' => 'Penjual/Menu/editToping/' . $toping_id
                ],
            ],
            'plugins' => [],
            'styles' => 'penjual/menu/edit-toping',
            'scripts' => 'penjual/menu/edit-toping',
            'toping' => $this->toping_model->find($toping_id),
        ];
        if (isset($_POST['submit'])) {
            $rules = [
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama makanan harus diisi'
                    ]
                ],
                'price' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'harga harus diisi'
                    ]
                ],
            ];
            if(!$this->validate($rules)){
                $alert = [
                    'Gagal!',
                    'gagal menambahkan toping',
                    'warning'
                ];
                session()->setFlashdata('flash' , implode('|' , $alert));
                return redirect()->back()->withInput();
            }
            $this->toping_model
            ->set('name' , $this->request->getPost('name'))
            ->set('price' , $this->request->getPost('price'))
            ->where('id' , $toping_id)
            ->update();
            $alert = [
                'Berhasil!',
                'data toping berhasil diubah.',
                'success'
            ];

            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Penjual/Menu/detail/'.$menu_id));

        }
        return view('penjual/menu/edit-toping' , $data);
    }

    public function deleteToping($toping_id=null)
    {
        if(!$toping_id){
            return $this->fail('toping tidak ditemukan' , 400);
        }
        $toping = $this->toping_model->find($toping_id);
        if($toping){
            $this->toping_model->delete($toping_id);
            return $this->respond($toping);
        }else{
            return $this->fail('toping tidak ditemukan' , 400);
        };
    }
}
