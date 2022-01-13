<?php

namespace App\Controllers\Pembeli;
use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\TopingModel;
use App\Models\TransactionMenuModel;
use App\Models\TransactionModel;
use App\Models\TransactionTopingModel;
use CodeIgniter\API\ResponseTrait;

class Pay extends BaseController
{
    use ResponseTrait;
    // protected $menu_model = null;
    protected $transaction_model = null;
    protected $transaction_menu_model = null;
    // protected $toping_model = null;
    protected $transaction_toping_model = null;

    public function __construct()
    {
        // $this->menu_model = new MenuModel();
        $this->transaction_model = new TransactionModel();
        $this->transaction_menu_model = new TransactionMenuModel();
        // $this->toping_model = new TopingModel();
        $this->transaction_toping_model = new TransactionTopingModel();
    }

    public function index()
    {
        $user_id = session()->id;
        $transaction = $this->transaction_model->checkTransaction($user_id , 1);
        if($transaction){
            $this->transaction_model->set('status' , 2)->set('noted' , $this->request->getPost('noted'))->where('user_id' , $user_id)->where('status' , 1)->update();
            return redirect()->to(base_url('Pembeli/WaitingList'));
        }else{
            return redirect()->to(base_url('Pembeli/Order'));
        }
    }

}
