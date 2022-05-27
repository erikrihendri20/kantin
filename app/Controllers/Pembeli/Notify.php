<?php

namespace App\Controllers\Pembeli;
use App\Controllers\BaseController;
use App\Models\TransactionMenuModel;
use App\Models\TransactionModel;
use App\Models\TransactionTopingModel;
use CodeIgniter\API\ResponseTrait;

class Notify extends BaseController
{
    use ResponseTrait;
    // protected $menu_model = null;
    protected $transaction_model = null;
    // protected $transaction_menu_model = null;
    // protected $toping_model = null;
    // protected $transaction_toping_model = null;
    // protected $report_model = null;
    // protected $user_log_model = null;

    public function __construct()
    {
        // $this->menu_model = new MenuModel();
        $this->transaction_model = new TransactionModel();
        // $this->transaction_menu_model = new TransactionMenuModel();
        // $this->toping_model = new TopingModel();
        // $this->transaction_toping_model = new TransactionTopingModel();
        // $this->report_model = new ReportModel();
        // $this->user_log_model = new UserLogModel();
        session();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function getNotifyPembeli()
    {
        $user_id = session()->id;
        return $this->respond($transaction = $this->transaction_model
        ->where('user_id' , $user_id)
        ->orderBy('updated_at' , 'DESC')
        ->limit(5)
        ->get()
        ->getResultArray());
    }

    public function setNotify($status , $transaction_id)
    {
        try {
            $this->transaction_model
            ->set('notify' , $status)
            ->where('id' , $transaction_id)
            ->update();
            return $this->respond(['status' => 'success']);
        
        } catch (\Throwable $th) {
            //throw $th;
            return $this->fail($th->getMessage());
        }
    }
}



// <!-- <a href="#" class="dropdown-item">
//                 <i class="fas fa-envelope mr-2"></i> 4 new messages
//                 <span class="float-right text-muted text-sm">3 mins</span>
//               </a> -->