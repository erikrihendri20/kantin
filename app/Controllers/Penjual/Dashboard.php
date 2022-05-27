<?php

namespace App\Controllers\Penjual;
use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\TransactionMenuModel;
use App\Models\TransactionModel;
use App\Models\TransactionTopingModel;
use App\Models\UserLogModel;
use CodeIgniter\API\ResponseTrait;

class Dashboard extends BaseController
{
    use ResponseTrait;
    protected $menu_model = null;
    protected $transaction_model = null;
    protected $transaction_menu_model = null;
    // protected $toping_model = null;
    protected $transaction_toping_model = null;
    protected $user_log_model = null;

    public function __construct()
    {
        $this->menu_model = new MenuModel();
        $this->transaction_model = new TransactionModel();
        $this->transaction_menu_model = new TransactionMenuModel();
        // $this->toping_model = new TopingModel();
        $this->transaction_toping_model = new TransactionTopingModel();
        $this->user_log_model = new UserLogModel();
    }

    public function index()
    {
        $data = [
            'header_title' => 'Dashboard | Kantin STIS',
            'active' => 'Dashboard',
            'nav' => [
                [
                    'title' => 'Dashboard',
                    'url' => 'Penjual/Dashboard'
                ],
            ],
            'plugins' => [
                'chartjs',
                'datatable',
            ],
            'visitor' => count($this->user_log_model->getVisitor()),
            'styles' => 'penjual/dashboard/index',
            'scripts' => 'penjual/dashboard/index'
        ];
        
        return view('penjual/dashboard/index' , $data);  
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
                    users.name as name,
                    transaction.rating')
                ->whereIn('transaction.status' , [5,9])
                ->where('transaction.canteen_id',$canteen_id)
                ->where('transaction.updated_at BETWEEN "'. $start_date.' 23:59:59'. '" and "'. $end_date.' 23:59:59'.'"')
                ->get()->getResultArray();

                $menu_transaction = $this->transaction_menu_model
                    ->join('transaction' , 'transaction_menu.transaction_id=transaction.id')
                    ->join('menu' , 'transaction_menu.menu_id = menu.id')
                    ->whereIn('transaction.status' , [5,9])
                    ->where('transaction.canteen_id' , $canteen_id)
                    ->select('transaction.id as transaction_id , transaction_menu.id transaction_menu_id , count , transaction_menu.menu_id as menu_id , transaction_menu.price as transaction_menu_price , photo , menu.name as name , transaction_menu.updated_at as updated_at , menu.rating as rating')
                    ->where('transaction.updated_at BETWEEN "'. $start_date.' 23:59:59'. '" and "'. $end_date.' 23:59:59'.'"')
                    ->get()
                    ->getResultArray();
                    
                
                $transaction_toping = $this->transaction_toping_model
                    ->join('transaction_menu' , 'transaction_toping.transaction_menu_id=transaction_menu.id')
                    ->join('transaction' , 'transaction_menu.transaction_id=transaction.id')
                    ->join('toping' , 'transaction_toping.toping_id=toping.id')
                    ->whereIn('transaction.status', [5,9])
                    ->where('transaction.canteen_id',$canteen_id)
                    ->select('transaction_menu.id as transaction_menu_id , transaction_menu.menu_id as menu_id , toping.name as name ,
                    transaction_toping.toping_id as toping_id , transaction_toping.price')
                    ->where('transaction.updated_at BETWEEN "'. $start_date.' 23:59:59'. '" and "'. $end_date.' 23:59:59'.'"')
                    ->get()
                    ->getResultArray();
                
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
                users.name as name,
                transaction.rating')
            ->whereIn('transaction.status' , [5,9])
            ->where('transaction.canteen_id',$canteen_id)
            ->get()->getResultArray();
            $menu_transaction = $this->transaction_menu_model
                ->join('transaction' , 'transaction_menu.transaction_id=transaction.id')
                ->join('menu' , 'transaction_menu.menu_id = menu.id')
                ->whereIn('transaction.status' , [5,9])
                ->where('transaction.canteen_id' , $canteen_id)
                ->select('transaction.id as transaction_id , transaction_menu.id transaction_menu_id , count , transaction_menu.menu_id as menu_id , transaction_menu.price as transaction_menu_price , photo , menu.name as name , transaction_menu.updated_at as updated_at , menu.rating as rating')
                ->get()
                ->getResultArray();
            
            $transaction_toping = $this->transaction_toping_model
            ->join('transaction_menu' , 'transaction_toping.transaction_menu_id=transaction_menu.id')
            ->join('transaction' , 'transaction_menu.transaction_id=transaction.id')
            ->join('toping' , 'transaction_toping.toping_id=toping.id')
            ->whereIn('transaction.status', [5,9])
            ->where('transaction.canteen_id',$canteen_id)
            ->select('transaction_menu.id as transaction_menu_id , transaction_menu.menu_id as menu_id , toping.name as name ,
            transaction_toping.toping_id as toping_id , transaction_toping.price')
            ->get()
            ->getResultArray();
        }

        
        return $this->respond([
            'transaction' => $transaction,
            'menu' => $this->menu_model->where('user_id' , $canteen_id)->where('menu.deleted_at' , null)->get()->getResultArray(),
            'transaction_menu' => $menu_transaction,
            'transaction_toping' => $transaction_toping
        ]);
    }

}
