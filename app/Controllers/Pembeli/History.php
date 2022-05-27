<?php

namespace App\Controllers\Pembeli;
use App\Controllers\BaseController;
use App\Models\CanteenInfoModel;
use App\Models\MenuModel;
// use App\Models\MenuModel;
// use App\Models\TopingModel;
use App\Models\TransactionMenuModel;
use App\Models\TransactionModel;
use App\Models\TransactionTopingModel;
use App\Models\UserLogModel;
// use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class History extends BaseController
{
    use ResponseTrait;
    // protected $user_model = null;
    protected $menu_model = null;
    protected $transaction_model = null;
    protected $transaction_menu_model = null;
    // protected $toping_model = null;
    protected $transaction_toping_model = null;
    protected $canteen_info = null;
    protected $user_log_model = null;


    public function __construct()
    {
        // $this->user_model = new UserModel();
        $this->menu_model = new MenuModel();
        $this->transaction_model = new TransactionModel();
        $this->transaction_menu_model = new TransactionMenuModel();
        $this->transaction_toping_model = new TransactionTopingModel();
        $this->canteen_info = new CanteenInfoModel();
        // $this->toping_model = new TopingModel();
        $this->user_log_model = new UserLogModel();
    }

    public function index()
    {
        $data = [
            'header_title' => 'History | Kantin STIS',
            'active' => 'History',
            'nav' => [
                [
                    'title' => 'Riwayat',
                    'url' => 'Pembeli/History'
                ],
            ],
            'plugins' => [],
            'styles' => 'pembeli/history/index',
            'visitor' => count($this->user_log_model->getVisitor()),
            'scripts' => 'pembeli/history/index'
        ];
        return view('pembeli/history/index' , $data);  
    }

    public function getMenu()
    {
        $user_id = session()->id;
        $status_transaction = $this->request->getGet('status');
        $start_date = $this->request->getGet('start-date').' 23:59:59';
        $end_date = $this->request->getGet('end-date').' 23:59:59';
        return $this->respond([
            'transaction' => $this->transaction_model
            ->whereIn('status' , [$status_transaction])
            ->where('user_id',$user_id)
            ->orderBy('id','DESC')
            ->where('transaction.created_at BETWEEN "'. $start_date. '" and "'. $end_date .'"')
            ->get()->getResultArray(),
            'menu' => $this->transaction_menu_model->getMenuTransaction($user_id , [$status_transaction] , [
                'start-date' => $start_date,
                'end-date' => $end_date,
            ]),
            'toping' => $this->transaction_toping_model->getTopingTransaction($user_id , [$status_transaction] , [
                'start-date' => $start_date,
                'end-date' => $end_date,
            ])
        ]);
    }

    public function rating()
    {
        $transaction_id = $this->request->getPost('transaction_id');
        $val = $this->request->getPost('val');
        $comment = $this->request->getPost('comment');
        $transaction = $this->transaction_model->find($transaction_id);
        if(!$transaction){
            return $this->respond($transaction);
        }
        if($val==null || $transaction['rating'] || $transaction['status']!=5){
            return $this->respond($transaction);
        }
        $canteen_id = $transaction['canteen_id'];
        $menu_transaction = $this->transaction_menu_model->where('transaction_id' , $transaction_id)->get()->getResultArray();

        $menu_id = [];
        foreach ($menu_transaction as $m) {
            $menu_id[] = $m['menu_id'];
        }
        
        $canteen = $this->canteen_info->where('user_id' , $canteen_id)->get()->getRowArray();
        $menu = $this->menu_model->whereIn('id' , $menu_id)->get()->getResultArray();
        
        // canteen info rating
        $this->transaction_model->save(['id' => $transaction_id , 'rating' => $val , 'comment' => $comment]);
        if($canteen['count_buyer']!=0){
            $canteen_rating_new_value = ($canteen['count_buyer']*$canteen['rating']+$val)/($canteen['count_buyer']+1);
        }else{
            $canteen_rating_new_value = $val;
        }
        $this->canteen_info->save(['id' => $canteen['id'] , 'rating' => $canteen_rating_new_value , 'count_buyer' => $canteen['count_buyer']+1]);

        // menu rating
        foreach ($menu as $m) {
            if($m['count_purchased']!=0){
                $menu_rating_new_value = ($m['count_purchased']*$m['rating']+$val)/($m['count_purchased']+1);
            }else{
                $menu_rating_new_value = $val;
            }
            $this->menu_model->set('rating',$menu_rating_new_value)->set('count_purchased',($m['count_purchased']+1))->where('id' , $m['id'])->update();
        }

        // return $this->respond();

    }
}

