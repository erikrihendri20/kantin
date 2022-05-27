<?php

namespace App\Controllers\Penjual;
use App\Controllers\BaseController;
use App\Models\ReportModel;
use App\Models\TransactionMenuModel;
use App\Models\TransactionModel;
use App\Models\TransactionTopingModel;
use App\Models\UserLogModel;
use CodeIgniter\API\ResponseTrait;

class Order extends BaseController
{
    use ResponseTrait;
    // protected $menu_model = null;
    protected $transaction_model = null;
    protected $transaction_menu_model = null;
    // protected $toping_model = null;
    protected $transaction_toping_model = null;
    protected $report_model = null;
    protected $user_log_model = null;

    public function __construct()
    {
        // $this->menu_model = new MenuModel();
        $this->transaction_model = new TransactionModel();
        $this->transaction_menu_model = new TransactionMenuModel();
        // $this->toping_model = new TopingModel();
        $this->transaction_toping_model = new TransactionTopingModel();
        $this->report_model = new ReportModel();
        $this->user_log_model = new UserLogModel();
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
            'visitor' => count($this->user_log_model->getVisitor()),
            'styles' => 'penjual/order/index',
            'scripts' => 'penjual/order/index'
        ];
        return view('penjual/order/index' , $data);  
    }

    public function getTransaction()
    {
        $canteen_id = session()->id;
        $keyword = $this->request->getGet('keyword');
        if($keyword){
            $transaction = $this->transaction_model
            ->join('users' , 'users.id=transaction.user_id')
            ->whereIn('transaction.status' , [2,3])
            ->where('canteen_id',$canteen_id)
            ->select(
                'transaction.id as id,
                users.id as users_id,
                users.email as email,
                transaction.status as status,
                transaction.canteen_id as canteen_id,
                transaction.noted as noted,
                transaction.rating as rating,
                users.name as name,
                transaction.order_option as order_option,
                '
            )
            ->like('users.name' , $keyword)
            ->limit(10,0)
            ->get()->getResultArray();
        }else{
            $transaction = $this->transaction_model
            ->join('users' , 'users.id=transaction.user_id')
            ->whereIn('transaction.status' , [2,3])
            ->where('canteen_id',$canteen_id)
            ->select(
                'transaction.id as id,
                users.id as users_id,
                users.email as email,
                transaction.status as status,
                transaction.canteen_id as canteen_id,
                transaction.noted as noted,
                transaction.rating as rating,
                users.name as name,
                transaction.order_option as order_option,
                '
            )
            ->limit(10,0)
            ->get()->getResultArray();
        }
        return $this->respond([
            'transaction' => $transaction,
            // menu dan toping belum dikasih limit
            'menu' => $this->transaction_menu_model->getMenuOrderList($canteen_id , [2,3] , 100 , 0),
            'toping' => $this->transaction_toping_model->getTopingOrderList($canteen_id , [2,3] , 1000, 0)
        ]);
    }

    public function cancleOrder()
    {
        $transaction_id = $this->request->getPost('transaction_id');
        $transaction = $this->transaction_model->find($transaction_id);
        if($transaction){
            if(!in_array($transaction['status'],[2,3])){
                return $this->fail('pesanan tidak dapat dibatalkan' , 500);
            }
            try {
                // $this->transaction_toping_model->deleteTopingCart($transaction_id);
                // $this->transaction_menu_model->deleteMenuCart($transaction_id);
                // $this->transaction_model->delete($transaction_id);
                $this->transaction_model->set('status',9)->set('notify',1)->update($transaction_id);
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
                $this->transaction_model->set('status' , 3)->set('notify' , 1)->where('id' , $transaction_id)->update();
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
                $this->transaction_model->set('status' , 4)->set('notify' , 1)->where('id' , $transaction_id)->update();
                //code...
                return $this->respond('order serve' , 200);
            } catch (\Throwable $th) {
                return $this->fail($th);
            }
        }
    }

    public function updateToping()
    {
        $topingId = $this->request->getPost('id');
        $transaction = $this->transaction_toping_model
        ->join('transaction_menu' , 'transaction_menu.id=transaction_toping.transaction_menu_id')
        ->join('transaction' , 'transaction.id=transaction_menu.transaction_id')
        ->where('transaction_toping.id',$topingId)
        ->where('transaction.status',2)
        ->get()->getRowArray();
        if(!$transaction){
            return $this->fail('not found',404);
        }
        $this->transaction_toping_model->delete($topingId);
        return $this->respond('deleted');
    }

}
