<?php

namespace App\Controllers\Penjual;
use App\Controllers\BaseController;
use App\Models\TransactionMenuModel;
use App\Models\TransactionModel;
use App\Models\TransactionTopingModel;
use CodeIgniter\API\ResponseTrait;

class Order extends BaseController
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
            'header_title' => 'Daftar Pesanan | Kantin STIS',
            'active' => 'Order',
            'nav' => [
                [
                    'title' => 'Daftar Pesanan',
                    'url' => 'Penjual/Order'
                ],
            ],
            'plugins' => [],
            'styles' => 'penjual/order/index',
            'scripts' => 'penjual/order/index'
        ];
        return view('penjual/order/index' , $data);  
    }


    public function getTransaction()
    {
        $canteen_id = session()->id;
        return $this->respond([
            'transaction' => $this->transaction_model->whereIn('status' , [2,3])->where('canteen_id',$canteen_id)->get()->getResultArray(),
            'menu' => $this->transaction_menu_model->getMenuOrderList($canteen_id , [2,3]),
            'toping' => $this->transaction_toping_model->getTopingOrderList($canteen_id , [2,3])
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

    public function acceptOrder()
    {
        $transaction_id = $this->request->getPost('transaction_id');
        $transaction = $this->transaction_model->find($transaction_id);
        if($transaction){
            if($transaction['status']!=2){
                return $this->fail('tidak dapat menerima pesanan' , 500);
            }
            try {
                $this->transaction_model->set('status' , 3)->where('id' , $transaction_id)->update();
                //code...
                return $this->respond('order accept' , 200);
            } catch (\Throwable $th) {
                return $this->fail($th);
            }
        }
    }
    public function serveOrder()
    {
        $transaction_id = $this->request->getPost('transaction_id');
        $transaction = $this->transaction_model->find($transaction_id);
        if($transaction){
            if($transaction['status']!=3){
                return $this->fail('tidak dapat menyelesaikan pesanan' , 500);
            }
            try {
                $this->transaction_model->set('status' , 4)->where('id' , $transaction_id)->update();
                //code...
                return $this->respond('order serve' , 200);
            } catch (\Throwable $th) {
                return $this->fail($th);
            }
        }
    }

}
