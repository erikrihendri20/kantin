<?php

namespace App\Controllers\Pembeli;
use App\Controllers\BaseController;
use App\Models\TransactionMenuModel;
use App\Models\TransactionModel;
use App\Models\TransactionTopingModel;
use App\Models\UserLogModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class Testing extends BaseController
{
    use ResponseTrait;
    protected $transaction_model = null;
    protected $user_model = null;
    protected $transaction_menu_model = null;
    protected $transaction_toping_model = null;
    protected $user_log_model = null;
    public function __construct()
    {
        $this->transaction_model = new TransactionModel();
        $this->user_model = new UserModel();
        $this->transaction_menu_model = new TransactionMenuModel();
        $this->transaction_toping_model = new TransactionTopingModel();
        $this->user_log_model = new UserLogModel();
    }

    public function index()
    {
        $data = [
            'header_title' => 'Testing | Kantin STIS',
            'active' => 'Testing',
            'nav' => [
                [
                    'title' => 'Testing',
                    'url' => 'Pembeli/Testing'
                ],
            ],
            'plugins' => [],
            'visitor' => count($this->user_log_model->getVisitor()),
            'styles' => 'pembeli/testing/index',
            'scripts' => 'pembeli/testing/index'
        ];
        return view('pembeli/testing/index' , $data);  
    }

    public function logTransaction()
    {
        $data = [
            'header_title' => 'Log | Kantin STIS',
            'active' => 'Log',
            'nav' => [
                [
                    'title' => 'Log',
                    'url' => 'Pembeli/logTransaction'
                ],
            ],
            'plugins' => [],
            'styles' => 'pembeli/log-transaction/index',
            'visitor' => count($this->user_log_model->getVisitor()),
            'scripts' => 'pembeli/log-transaction/index'
        ];
        return view('pembeli/log-transaction/index' , $data);  
    }

    public function getNumberTransaction()
    {
        return $this->respond([
            'transaction' => $this->transaction_model->countAllResults(),
            'menu' => $this->transaction_menu_model->countAllResults(),
            'toping' => $this->transaction_toping_model->countAllResults(),
        ]);
    }

    public function getStatusCanteen()
    {
        return $this->respond($this->user_model->join('canteen_info' , 'users.id=canteen_info.user_id')
        ->where('users.id' , 3)
        ->get()->getRowArray());
    }

    // public function coba()
    // {
    //     $config = fopen("./.canteen_config" , "r");
    //     $config_canteen = fread($config , filesize("./.canteen_config"));
    //     $config_canteen = json_decode($config_canteen , true);
    //     $config_canteen["coba1"] = "coba2";
    //     fclose($config);
    //     $config = fopen("./.canteen_config" , "w");
    //     fwrite($config , json_encode($config_canteen));

    // }
    
    // public function coba2()
    // {
    //     dd(apache_getenv("hai"));
    // }

}
