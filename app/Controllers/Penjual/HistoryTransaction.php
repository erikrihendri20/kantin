<?php

namespace App\Controllers\Penjual;
use App\Controllers\BaseController;
use App\Models\TransactionMenuModel;
use App\Models\TransactionModel;
use App\Models\TransactionTopingModel;
use CodeIgniter\API\ResponseTrait;

class HistoryTransaction extends BaseController
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
            'header_title' => 'History Transaction | Kantin STIS',
            'active' => 'History Transaction',
            'nav' => [
                [
                    'title' => 'Riwayat Penjualan',
                    'url' => 'Penjual/HistoryTransaction'
                ],
            ],
            'plugins' => [
                'datatable'
            ],
            'styles' => 'penjual/history-transaction/index',
            'scripts' => 'penjual/history-transaction/index'
        ];
        return view('penjual/history-transaction/index' , $data);  
    }

    public function getTransaction()
    {
        $canteen_id = session()->id;
        $start_date = $this->request->getGet('start-date');
        $end_date = $this->request->getGet('end-date');
        if($start_date!=''){
            if($end_date!=''){
                $transaction = $this->transaction_model
                ->join('users' , 'users.id=transaction.user_id')
                ->select('transaction.id as id,
                    transaction.user_id as user_id,
                    transaction.status as status,
                    transaction.canteen_id as canteen_id,
                    transaction.noted as noted,
                    transaction.created_at as created_at,
                    transaction.updated_at as updated_at,
                    users.name as name')
                ->whereIn('transaction.status' , [5,9])
                ->where('transaction.canteen_id',$canteen_id)
                ->where('transaction.updated_at BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"')
                ->get()->getResultArray();
            }
        }else{
            $transaction = $this->transaction_model
            ->join('users' , 'users.id=transaction.user_id')
            ->select('transaction.id as id,
                transaction.user_id as user_id,
                transaction.status as status,
                transaction.canteen_id as canteen_id,
                transaction.noted as noted,
                transaction.created_at as created_at,
                transaction.updated_at as updated_at,
                users.name as name')
            ->whereIn('transaction.status' , [5,9])
            ->where('transaction.canteen_id',$canteen_id)
            ->get()->getResultArray();
        }
        return $this->respond([
            'transaction' => $transaction,
            'menu' => $this->transaction_menu_model->getMenuOrderList($canteen_id , [5,9]),
            'toping' => $this->transaction_toping_model->getTopingOrderList($canteen_id , [5,9])
        ]);
    }

}
