<?php

namespace App\Controllers\Pembeli;
use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\TopingModel;
use App\Models\TransactionMenuModel;
use App\Models\TransactionModel;
use App\Models\TransactionTopingModel;
use App\Models\UserLogModel;
use CodeIgniter\API\ResponseTrait;

class WaitingList extends BaseController
{
    use ResponseTrait;
    // protected $menu_model = null;
    protected $transaction_model = null;
    protected $transaction_menu_model = null;
    // protected $toping_model = null;
    protected $transaction_toping_model = null;
    protected $user_log_model = null;

    public function __construct()
    {
        // $this->menu_model = new MenuModel();
        $this->transaction_model = new TransactionModel();
        $this->transaction_menu_model = new TransactionMenuModel();
        // $this->toping_model = new TopingModel();
        $this->transaction_toping_model = new TransactionTopingModel();
        $this->user_log_model = new UserLogModel();
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
            'visitor' => count($this->user_log_model->getVisitor()),
            'styles' => 'pembeli/waitinglist/index',
            'scripts' => 'pembeli/waitinglist/index'
        ];
        return view('pembeli/waitinglist/index' , $data);  
    }

    public function getMenu()
    {
        $user_id = session()->id;
        return $this->respond([
            'transaction' => $this->transaction_model
            ->join('users','transaction.canteen_id=users.id')
            ->join('canteen_info','users.id=canteen_info.user_id')
            ->select('transaction.id as id , transaction.user_id as user_id , transaction.status as status , transaction.canteen_id as canteen_id, transaction.noted as noted , transaction.rating as rating , canteen_info.name as canteen name, users.name as user_name , users.email as email , transaction.updated_at as updated_at , transaction.time_estimate, transaction.order_option as order_option')
            ->whereIn('transaction.status' , [2,3,4])
            ->where('transaction.user_id',$user_id)
            ->orderBy('transaction.status','ASC')
            ->orderBy('transaction.id','DESC')
            ->get()->getResultArray(),
            'menu' => $this->transaction_menu_model->getMenuTransaction($user_id , [2,3,4]),
            'toping' => $this->transaction_toping_model->getTopingTransaction($user_id , [2,3,4])
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
                // $this->transaction_toping_model->deleteTopingCart($transaction_id);
                // $this->transaction_menu_model->deleteMenuCart($transaction_id);
                // $this->transaction_model->delete($transaction_id);
                $this->transaction_model->set('status',9)->update($transaction_id);
                //code...
                return $this->respond('deleted' , 200);
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
