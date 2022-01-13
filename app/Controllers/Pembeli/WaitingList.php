<?php

namespace App\Controllers\Pembeli;
use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\TopingModel;
use App\Models\TransactionMenuModel;
use App\Models\TransactionModel;
use App\Models\TransactionTopingModel;
use CodeIgniter\API\ResponseTrait;

class WaitingList extends BaseController
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

        $data = [
            'header_title' => 'Waiting List | Kantin STIS',
            'active' => 'WaitingList',
            'nav' => [
                [
                    'title' => 'Tunggu Pesanan',
                    'url' => 'Pembeli/WaitingList'
                ],
            ],
            'plugins' => [],
            'styles' => 'pembeli/waitinglist/index',
            'scripts' => 'pembeli/waitinglist/index'
        ];
        return view('pembeli/waitinglist/index' , $data);  
    }

    public function getMenu()
    {
        $user_id = session()->id;
        return $this->respond([
            'transaction' => $this->transaction_model->whereIn('status' , [2,3,4,5,9])->where('user_id',$user_id)->get()->getResultArray(),
            'menu' => $this->transaction_menu_model->getMenuTransaction($user_id , [2,3,4,5,9]),
            'toping' => $this->transaction_toping_model->getTopingTransaction($user_id , [2,3,4,5,9])
        ]);
    }

    public function cancleOrder()
    {
        $transaction_id = $this->request->getPost('transaction_id');
        $transaction = $this->transaction_model->find($transaction_id);
        if($transaction){
            if($transaction['status']!=2){
                return $this->fail('pesanan tidak dapat dibatalkan' , 500);
            }
            try {
                $this->transaction_toping_model->deleteTopingCart($transaction_id);
                $this->transaction_menu_model->deleteMenuCart($transaction_id);
                $this->transaction_model->delete($transaction_id);
                //code...
                return $this->respond('deleted' , 200);
            } catch (\Throwable $th) {
                return $this->fail($th);
            }
        }
    }

    public function takeOrder()
    {
        $transaction_id = $this->request->getPost('transaction_id');
        $transaction = $this->transaction_model->find($transaction_id);
        if($transaction){
            if($transaction['status']!=4){
                return $this->fail('pesanan sudah diambil' , 500);
            }
            try {
                $this->transaction_model->takeOrder($transaction_id , 5);
                //code...
                return $this->respond('took' , 200);
            } catch (\Throwable $th) {
                return $this->fail($th);
            }
        }
    }

}
