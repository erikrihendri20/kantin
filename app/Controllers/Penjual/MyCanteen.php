<?php

namespace App\Controllers\Penjual;
use App\Controllers\BaseController;
use App\Models\CanteenInfoModel;
use App\Models\UserLogModel;
// use App\Models\MenuModel;
// use App\Models\MenuTypeModel;
// use App\Models\TopingModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class MyCanteen extends BaseController
{
    use ResponseTrait;
    // protected $menu_model = null;
    // protected $toping_model = null;
    protected $user_model = null;
    protected $canteen_info_model = null;
    // protected $menu_type_model = null;
    protected $user_log_model = null;

    public function __construct()
    {
        session();
        // $this->menu_model = new MenuModel();
        // $this->toping_model = new TopingModel();
        // $this->menu_type_model = new MenuTypeModel();
        $this->user_model = new UserModel();
        $this->canteen_info_model = new CanteenInfoModel();
        $this->user_log_model = new UserLogModel();
    }

    public function index()
    {
        $canteen_id = session()->id;
        $canteen = $this->user_model->getStand($canteen_id);
        if(!$canteen['canteen_info_id']){
            $this->canteen_info_model->insert([
                'user_id' => $canteen_id,
                'rating' => 0,
                'stand_picture' => 'default.png',
                'open_hours' => '08:00',
                'close_hours' => '16:00',
            ]);
            $canteen = $this->user_model->getStand($canteen_id);
        }
        $data = [
            'header_title' => 'My Canteen | Kantin STIS',
            'active' => 'My Canteen',
            'nav' => [
                [
                    'title' => 'Kantinku',
                    'url' => 'Penjual/MyCanteen'
                ],
            ],
            'plugins' => [],
            'visitor' => count($this->user_log_model->getVisitor()),
            'styles' => 'penjual/my-canteen/index',
            'scripts' => 'penjual/my-canteen/index',
            'canteen' => $canteen
        ];
        return view('penjual/my-canteen/index' , $data);  
    }

    public function updateCanteen()
    {
        $canteen_id = session()->id;
        if(isset($_POST['submit'])){
            $rules = [
                'canteen-name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama kantin harus diisi'
                    ]
                ],
                'photo' => [
                    'rules' => 'mime_in[photo,image/jpg,image/jpeg,image/png]|max_size[photo,1000]',
                    'errors' => [
                        'mime_in' => 'gunakan ekstensi jpg,png,jpeg',
                        'max_size' => 'ukuran gambar maksimal 1 mb'
                    ]
                ],
            ];
            if(!$this->validate($rules)){
                $alert = [
                    'Gagal!',
                    'gagal mengubah data kantin',
                    'warning'
                ];
                session()->setFlashdata('flash' , implode('|' , $alert));
                return redirect()->back()->withInput();
            }

            $canteen = $this->canteen_info_model->where('user_id' , $canteen_id)->get()->getRowArray();
            try {
                unlink('./assets/img/user/canteen/' . $canteen['stand_picture']);
                //code...
            } catch (\Throwable $th) {
                //throw $th;
            }

            $photo = $this->request->getFile('photo');
            if($photo->isValid()){
                $photoName = $photo->getRandomName();
                $photo->move('./assets/img/user/canteen/', $photoName);
            }else{
                $photoName = 'default.png';
            }


            $this->canteen_info_model
            ->set('name' , $this->request->getPost('canteen-name'))
            ->set('description' , $this->request->getPost('description'))
            ->set('status' , $this->request->getPost('canteen-status'))
            ->set('open_hours' , $this->request->getPost('open-hours'))
            ->set('close_hours' , $this->request->getPost('close-hours'))
            ->set('stand_picture' , $photoName)
            ->where('user_id' , $canteen_id)
            ->update();
            $alert = [
                'Berhasil!',
                'berhasil diubah.',
                'success'
            ];

            session()->setFlashdata('flash' , implode('|' , $alert));

            return redirect()->to(base_url('Penjual/MyCanteen'));
        }
        return redirect()->to(base_url('Penjual/MyCanteen'));
    }

    public function changeStatusCanteen()
    {
        $canteen_id = session()->id;
        $status = $this->request->getPost('canteen-status');
        if(in_array($status , [1,2])){
            $this->canteen_info_model
            ->set('status' , $status)
            ->where('user_id' , $canteen_id)
            ->update();
            return $this->respond('updated',200);
        }
        return $this->fail('fail update' , 500);
    }
}
