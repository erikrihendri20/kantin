<?php

namespace App\Controllers\Penjual;
use App\Controllers\BaseController;
use App\Models\ReportModel;
use App\Models\TransactionMenuModel;
use App\Models\TransactionModel;
use App\Models\TransactionTopingModel;
use App\Models\UserLogModel;
use CodeIgniter\API\ResponseTrait;

class Pay extends BaseController
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
            'header_title' => 'Membayar | Kantin STIS',
            'active' => 'Pay',
            'nav' => [
                [
                    'title' => 'Daftar Pesanan',
                    'url' => 'Penjual/Pay'
                ],
            ],
            'plugins' => [],
            'visitor' => count($this->user_log_model->getVisitor()),
            'styles' => 'penjual/pay/index',
            'scripts' => 'penjual/pay/index'
        ];
        return view('penjual/pay/index' , $data);  
    }

    
    public function getTransaction()
    {
        $canteen_id = session()->id;
        $keyword = $this->request->getGet('keyword');
        if($keyword){
            $transaction = $this->transaction_model
            ->join('users' , 'users.id=transaction.user_id')
            ->whereIn('transaction.status' , [4])
            ->where('canteen_id',$canteen_id)
            ->select(
                'transaction.id as id,
                users.id as users_id,
                users.email as email,
                transaction.status as status,
                transaction.canteen_id as canteen_id,
                transaction.noted as noted,
                transaction.rating as rating,
                users.name as name
                '
            )
            ->like('users.name' , $keyword)
            ->limit(10,0)
            ->get()->getResultArray();
        }else{
            $transaction = $this->transaction_model
            ->join('users' , 'users.id=transaction.user_id')
            ->whereIn('transaction.status' , [4])
            ->where('canteen_id',$canteen_id)
            ->select(
                'transaction.id as id,
                users.id as users_id,
                users.email as email,
                transaction.status as status,
                transaction.canteen_id as canteen_id,
                transaction.noted as noted,
                transaction.rating as rating,
                users.name as name
                '
            )
            ->limit(10,0)
            ->get()->getResultArray();
        }
        return $this->respond([
            'transaction' => $transaction,
            // menu dan toping belum dikasih limit
            'menu' => $this->transaction_menu_model->getMenuOrderList($canteen_id , [4] , 100 , 0),
            'toping' => $this->transaction_toping_model->getTopingOrderList($canteen_id , [4] , 1000, 0)
        ]);
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
                $this->transaction_model->set('notify' , 1)->where('id' , $transaction_id)->update();
                //code...
                return $this->respond('took' , 200);
            } catch (\Throwable $th) {
                return $this->fail($th);
            }
        }
    }

    public function report()
    {
        $reporter = session()->id;
        $transaction_id = $this->request->getPost('transaction_id');
        $transaction = $this->transaction_model->find($transaction_id);
        if($transaction){
            $report = $this->report_model->where('transaction_id' , $transaction_id)->where('reporter' , $reporter)->get()->getRowArray();
            if(!$report){
                $this->report_model->insert([
                    'transaction_id' => $transaction_id,
                    'reporter' => $reporter,
                    'reported' => $transaction['user_id'],
                    'comment' => $this->request->getPost('comment'),
                ]);
            }else{
                $comment = $report['comment'].'
'.$this->request->getPost('comment');
                $this->report_model->set('comment',$comment)->where('id', $report['id'])->update();
            }
            $this->transaction_model->set('status',8)->update($transaction_id);
        }
    }

}
