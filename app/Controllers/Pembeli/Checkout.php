<?php

namespace App\Controllers\Pembeli;
use App\Controllers\BaseController;
use App\Models\CanteenInfoModel;
use App\Models\MenuModel;
use App\Models\TopingModel;
use App\Models\TransactionMenuModel;
use App\Models\TransactionModel;
use App\Models\TransactionTopingModel;
use App\Models\UserLogModel;
use CodeIgniter\API\ResponseTrait;

class Checkout extends BaseController
{
    use ResponseTrait;
    protected $menu_model = null;
    protected $transaction_model = null;
    protected $transaction_menu_model = null;
    protected $toping_model = null;
    protected $transaction_toping_model = null;
    protected $user_log_model = null;
    protected $canteen_info_model = null;

    public function __construct()
    {
        $this->menu_model = new MenuModel();
        $this->transaction_model = new TransactionModel();
        $this->transaction_menu_model = new TransactionMenuModel();
        $this->toping_model = new TopingModel();
        $this->transaction_toping_model = new TransactionTopingModel();
        $this->user_log_model = new UserLogModel();
        $this->canteen_info_model = new CanteenInfoModel();
        
    }

    public function index()
    {
        if(!$this->transaction_menu_model->getMenuTransaction(session()->id , [1])){
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
            'visitor' => count($this->user_log_model->getVisitor()),
            'scripts' => 'pembeli/checkout/index'
        ];
        $this->sync();
        return view('pembeli/checkout/index' , $data);  
    }

    // public function getMenu()
    // {
    //     $user_id = session()->id;
    //     $transaction = $this->transaction_model
    //     ->where('status' , 1)
    //     ->where('user_id' , $user_id)
    //     ->get()->getRowArray();
    //     $menu_transaction = $this->transaction_menu_model->getMenuTransaction($user_id , 1);
    //     $toping_transaction = $this->transaction_toping_model->getTopingTransaction($user_id , 1);
    //     return $this->respond(['transaction' => $transaction ,'menu' => $menu_transaction , 'toping' => $toping_transaction]);
    // }

    public function getMenu()
    {
        $user_id = session()->id;
        $transaction = $this->transaction_model
        ->where('status' , 1)
        ->where('user_id' , $user_id)
        ->get()->getResultArray();
        $respond = [
            'transaction' => $transaction,
            'menu_transaction' => $this->transaction_menu_model->getMenuTransaction($user_id , [1]),
            'toping_transaction' => $this->transaction_toping_model->getTopingTransaction($user_id ,[1]),
        ];
        $this->sync();
        return $this->respond($respond);
    }

    public function changeOrderOption()
    {
        $option = $this->request->getPost('option');
        $this->transaction_model->set('order_option' , $option)
        ->where('status' , 1)
        ->where('user_id' , session()->id)
        ->update();
    }

    public function getOrderOption()
    {
        $user_id = session()->id;
        $transaction = $this->transaction_model
        ->where('status' , 1)
        ->where('user_id' , $user_id)
        ->get()->getRowArray();
        return $this->respond($transaction);
    }

    public function sync()
    {
        $user_id = session()->id;
        $transaction = $this->transaction_model->checkTransaction($user_id,null,1);
        // periksa apakah ada transaksi
        if(!$transaction){
            return false;
        }
        $transaction_id = [];
        foreach($transaction as $key => $value){
            $transaction_id[] = $value['id'];
        }
        $transaction_menu = $this->transaction_menu_model
        ->whereIn('transaction_id' , $transaction_id)
        ->get()
        ->getResultArray();
        if(!$transaction_menu){
            return false;
        }
        $transaction_menu_id = [];
        foreach ($transaction_menu as $key => $value) {
            $transaction_menu_id[] = $value['id'];
        }
        $transaction_toping = $this->transaction_toping_model
        ->whereIn('transaction_menu_id' , $transaction_menu_id)
        ->get()
        ->getResultArray();
        $menu = $this->menu_model->where('status',1)->where('deleted_at',null)->get()->getResultArray();
        $toping = $this->toping_model->where('status',1)->where('deleted_at',null)->get()->getResultArray();
        foreach ($transaction_menu as $key => $value) {
            $temp = array_search($value['menu_id'], array_column($menu, 'id'));
            if($temp===false){
                $this->transaction_toping_model->where('transaction_menu_id',$value['id'])->delete();
                $this->transaction_menu_model->delete($value['id']);
            }
        }
        foreach ($transaction_toping as $key => $value) {
            $temp = array_search($value['toping_id'], array_column($toping, 'id'));
            if($temp===false){
                $this->transaction_toping_model->delete($value['id']);
            }
        }
        foreach ($transaction as $key => $value) {
            $temp = [];
            $canteen_info = $this->canteen_info_model->where('user_id' , $value['canteen_id'])->get()->getRowArray();
            if(!$this->isNowBetweenTime($canteen_info['open_hours'],$canteen_info['close_hours'])||$canteen_info['status']==0){
                $temp = $this->transaction_menu_model->where('transaction_id',$value['id'])->get()->getResultArray();
                $this->transaction_menu_model->where('transaction_id',$value['id'])->delete();
                $this->transaction_model->delete($value['id']);
            }
            $this->transaction_toping_model->where('transaction_menu_id',$value['id'])->delete();
        }
    }

    
    // isnowbeetweentime
    private function isNowBetweenTime($start_time, $end_time)
    {
        $start_time = strtotime($start_time);
        $end_time = strtotime($end_time);
        $current_time = strtotime(date('H:i:s'));
        return (($current_time >= $start_time) && ($current_time <= $end_time));
    }
}
