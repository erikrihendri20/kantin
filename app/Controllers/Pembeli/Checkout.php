<?php

namespace App\Controllers\Pembeli;
use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\TopingModel;
use App\Models\TransactionMenuModel;
use App\Models\TransactionModel;
use App\Models\TransactionTopingModel;
use CodeIgniter\API\ResponseTrait;

class Checkout extends BaseController
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
        if(!$this->transaction_menu_model->getMenuTransaction(session()->id , 1)){
            return redirect()->to(base_url('Pembeli/Order'));
        }
        $data = [
            'header_title' => 'Checkout | Kantin STIS',
            'active' => 'Checkout',
            'nav' => [
                [
                    'title' => 'Checkout',
                    'url' => 'Pembeli/Checkout'
                ],
            ],
            'plugins' => [],
            'styles' => 'pembeli/checkout/index',
            'scripts' => 'pembeli/checkout/index'
        ];

        return view('pembeli/Checkout/index' , $data);  
    }

    public function getMenu()
    {
        $user_id = session()->id;
        $menu_transaction = $this->transaction_menu_model->getMenuTransaction($user_id , 1);
        $toping_transaction = $this->transaction_toping_model->getTopingTransaction($user_id , 1);
        return $this->respond(['menu' => $menu_transaction , 'toping' => $toping_transaction]);
    }


}
