<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\UserLogModel;
use App\Models\UserModel;
use App\Models\MenuModel;
use App\Models\TransactionModel;
use App\Models\TransactionMenuModel;
use App\Models\TransactionTopingModel;
use CodeIgniter\API\ResponseTrait;

class Dashboard extends BaseController
{
    use ResponseTrait;
    protected $user_log_model = null;
    protected $user_model = null;
    protected $menu_model = null;
    protected $transaction_model = null;
    protected $transaction_menu_model = null;
    protected $transaction_toping_model = null;

    public function __construct()
    {
        session();
        $this->user_log_model = new UserLogModel();
        $this->user_model = new UserModel();
        $this->menu_model = new MenuModel();
        $this->transaction_model = new TransactionModel();
        $this->transaction_menu_model = new TransactionMenuModel();
        $this->transaction_toping_model = new TransactionTopingModel();
    }

    public function index()
    {
        $user_model = new UserModel();
        $data = [
            'header_title' => 'Dashboard | Kantin STIS',
            'active' => 'Dashboard',
            'nav' => [
                [
                    'title' => 'Dashboard',
                    'url' => 'Admin/Dashboard'
                ],
            ],
            'plugins' => [
                'datatable',
                'chartjs'
            ],
            'styles' => 'admin/dashboard/index',
            'scripts' => 'admin/dashboard/index',
            'visitor' => count($this->user_log_model->getVisitor()),
            'users' => $user_model->findAll()
        ];
        return view('admin/dashboard/index' , $data);  
    }

    public function getTransaction()
    {
        $start_date = $this->request->getGet('start-date');
        $end_date = $this->request->getGet('end-date');        

        if($start_date!=''){
            if($end_date!=''){
                $transaction = $this->transaction_model
                ->join('users' , 'users.id=transaction.user_id')
                ->join('canteen_info' , 'transaction.canteen_id=canteen_info.user_id' , 'left')
                ->select('transaction.id as id,
                    transaction.user_id as user_id,
                    transaction.status as status,
                    transaction.canteen_id as canteen_id,
                    transaction.noted as noted,
                    transaction.created_at as created_at,
                    transaction.updated_at as updated_at,
                    users.name as name,
                    transaction.rating,
                    canteen_info.name as canteen_name')
                ->whereIn('transaction.status' , [5,9])
                ->where('transaction.updated_at BETWEEN "'. $start_date.' 23:59:59'. '" and "'. $end_date.' 23:59:59'.'"')
                ->get()->getResultArray();

                $menu_transaction = $this->transaction_menu_model
                    ->join('transaction' , 'transaction_menu.transaction_id=transaction.id')
                    ->join('menu' , 'transaction_menu.menu_id = menu.id')
                    ->whereIn('transaction.status' , [5,9])
                    ->select('transaction.id as transaction_id , transaction_menu.id transaction_menu_id , count , transaction_menu.menu_id as menu_id , transaction_menu.price as transaction_menu_price , photo , menu.name as name , transaction_menu.updated_at as updated_at , menu.rating as rating')
                    ->where('transaction.updated_at BETWEEN "'. $start_date.' 23:59:59'. '" and "'. $end_date.' 23:59:59'.'"')
                    ->get()
                    ->getResultArray();
                    
                
                $transaction_toping = $this->transaction_toping_model
                    ->join('transaction_menu' , 'transaction_toping.transaction_menu_id=transaction_menu.id')
                    ->join('transaction' , 'transaction_menu.transaction_id=transaction.id')
                    ->join('toping' , 'transaction_toping.toping_id=toping.id')
                    ->whereIn('transaction.status', [5,9])
                    ->select('transaction_menu.id as transaction_menu_id , transaction_menu.menu_id as menu_id , toping.name as name ,
                    transaction_toping.toping_id as toping_id , transaction_toping.price')
                    ->where('transaction.updated_at BETWEEN "'. $start_date.' 23:59:59'. '" and "'. $end_date.' 23:59:59'.'"')
                    ->get()
                    ->getResultArray();
                
            }
        }else{
            $transaction = $this->transaction_model
            ->join('users' , 'users.id=transaction.user_id')
            ->join('canteen_info' , 'transaction.canteen_id=canteen_info.user_id' , 'left')
            ->select('transaction.id as id,
                transaction.user_id as user_id,
                transaction.status as status,
                transaction.canteen_id as canteen_id,
                transaction.noted as noted,
                transaction.created_at as created_at,
                transaction.updated_at as updated_at,
                users.name as name,
                transaction.rating,
                canteen_info.name as canteen_name')
            ->whereIn('transaction.status' , [5,9])
            ->get()->getResultArray();
            $menu_transaction = $this->transaction_menu_model
                ->join('transaction' , 'transaction_menu.transaction_id=transaction.id')
                ->join('menu' , 'transaction_menu.menu_id = menu.id')
                ->whereIn('transaction.status' , [5,9])
                ->select('transaction.id as transaction_id , transaction_menu.id transaction_menu_id , count , transaction_menu.menu_id as menu_id , transaction_menu.price as transaction_menu_price , photo , menu.name as name , transaction_menu.updated_at as updated_at , menu.rating as rating')
                ->get()
                ->getResultArray();
            
            $transaction_toping = $this->transaction_toping_model
            ->join('transaction_menu' , 'transaction_toping.transaction_menu_id=transaction_menu.id')
            ->join('transaction' , 'transaction_menu.transaction_id=transaction.id')
            ->join('toping' , 'transaction_toping.toping_id=toping.id')
            ->whereIn('transaction.status', [5,9])
            ->select('transaction_menu.id as transaction_menu_id , transaction_menu.menu_id as menu_id , toping.name as name ,
            transaction_toping.toping_id as toping_id , transaction_toping.price')
            ->get()
            ->getResultArray();
        }

        
        return $this->respond([
            'transaction' => $transaction,
            'tenant' => $this->user_model->where('role' , 3)->get()->getResultArray(),
            'menu' => $this->menu_model->where('menu.deleted_at' , null)->get()->getResultArray(),
            'transaction_menu' => $menu_transaction,
            'transaction_toping' => $transaction_toping
        ]);
    }
}
