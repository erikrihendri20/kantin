<?php

namespace App\Controllers\Dev;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DevApiModel;
use App\Models\DevUserModel;

class Dashboard extends BaseController
{
    use ResponseTrait;
    protected $dev_user_model = null;
    protected $dev_api_model = null;

    public function __construct()
    {
        $this->dev_user_model = new DevUserModel();
        $this->dev_api_model = new DevApiModel();
    }

    public function index()
    {
        $dev_user_id = session()->get('dev_user_id');
        $data = [
            'header_title' => 'Dashboard Dev',
            'active' => 'Dashboard Dev',
            'nav' => [
                [
                    'title' => 'Dashboard Dev',
                    'url' => 'Dashboard'
                ],
            ],
            'plugins' => [],
            'styles' => 'dev/dashboard/index',
            'scripts' => 'dev/dashboard/index',
            'api' => $this->dev_api_model->where('dev_user_id' , $dev_user_id)->get()->getResultArray(),
        ];

        return view('dev/dashboard/index' , $data);
    }

    public function addApiKey()
    {
        $rules = [
            'application_name' => 'required|min_length[3]|max_length[50]',
            'application_type' => 'required',
            'url' => 'required|min_length[3]',
            'information' => 'required|min_length[3]',
        ];

        if(!$this->validate($rules)){
            $alert = [
                'Gagal!',
                'gagal mendaftarkan api',
                'warning'
            ];
            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Dev/Dashboard/index'))->withInput();
        }

        $data = [
            'dev_user_id' => session()->get('dev_user_id'),
            'application_name' => $this->request->getPost('application_name'),
            'application_type' => $this->request->getPost('application_type'),
            'url' => $this->request->getPost('url'),
            'information' => $this->request->getPost('information'),
            'status' => 1
        ];
        $data['api_key'] = md5($data['dev_user_id'] . $data['application_name'] . $data['application_type'] . $data['url'] . $data['information'] . time());
        $this->dev_api_model->insert($data);
        $alert = [
            'Sukses!',
            'berhasil mendaftarkan api',
            'success'
        ];
        session()->setFlashdata('flash' , implode('|' , $alert));
        return redirect()->to(base_url('Dev/Dashboard'))->withInput();
    }

    public function editApiKey($id)
    {
        $rules = [
            'application_name' => 'required|min_length[3]|max_length[50]',
            'application_type' => 'required',
            'url' => 'required|min_length[3]',
            'information' => 'required|min_length[3]',
        ];

        if(!$this->validate($rules)){
            $alert = [
                'Gagal!',
                'gagal mengubah api',
                'warning'
            ];
            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Dev/Dashboard/index'))->withInput();
        }

        $data = [
            'application_name' => $this->request->getPost('application_name'),
            'application_type' => $this->request->getPost('application_type'),
            'url' => $this->request->getPost('url'),
            'information' => $this->request->getPost('information'),
        ];

        $this->dev_api_model->set('application_name' , $data['application_name'])
                            ->set('application_type' , $data['application_type'])
                            ->set('url' , $data['url'])
                            ->set('information' , $data['information'])
                            ->where('id' , $id)
                            ->update();
        $alert = [
            'Sukses!',
            'berhasil mengubah api',
            'success'
        ];
        session()->setFlashdata('flash' , implode('|' , $alert));
        return redirect()->to(base_url('Dev/Dashboard'))->withInput();
    }

    public function deleteApiKey($id)
    {
        $this->dev_api_model->where('id' , $id)->delete();
        $alert = [
            'Sukses!',
            'berhasil menghapus api',
            'success'
        ];
        session()->setFlashdata('flash' , implode('|' , $alert));
        return redirect()->to(base_url('Dev/Dashboard'))->withInput();
    }

}

