<?php

namespace App\Controllers\Pembeli;
use App\Controllers\BaseController;
use App\Models\TestimonialModel;
use App\Models\UserLogModel;
use CodeIgniter\API\ResponseTrait;

class Testimonial extends BaseController
{
    use ResponseTrait;
    protected $user_log_model = null;
    protected $testimonial_model = null;

    public function __construct()
    {
        $this->user_log_model = new UserLogModel();
        $this->testimonial_model = new TestimonialModel();
    }

    public function index()
    {
        $data = [
            'header_title' => 'Kritik dan Saran| Kantin STIS',
            'active' => 'Testimonial',
            'nav' => [
                [
                    'title' => 'Testimonial',
                    'url' => 'Pembeli/Testimonial'
                ],
            ],
            'plugins' => [],
            'styles' => 'pembeli/testimonial/index',
            'visitor' => count($this->user_log_model->getVisitor()),
            'scripts' => 'pembeli/testimonial/index'
        ];
        return view('pembeli/testimonial/index' , $data);  
    }

    public function sendTestimonial()
    {
        $rules = [
            'message' => [
                'label' => 'Pesan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
        ];
        if(!$this->validate($rules)){
            $data = [
                'status' => 'error',
                'message' => $this->validator->getErrors()
            ];
            $alert = [
                'Gagal!',
                'gagal mengirim masukan',
                'warning'
            ];
            session()->setFlashdata('flash' , implode('|' , $alert));
            return redirect()->to(base_url('Pembeli/Testimonial'))->withInput();
        }
        $data = [
            'message' => $this->request->getPost('message'),
            'user_id' => session()->id
        ];
        $this->testimonial_model->insert($data);
        $alert = [
            'Berhasil!',
            'terimakasih telah memberikan masukan',
            'success'
        ];
        session()->setFlashdata('flash' , implode('|' , $alert));
        return redirect()->to(base_url('Pembeli/Testimonial'));
    }
}

