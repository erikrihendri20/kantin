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
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class Pay extends BaseController
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
        foreach ($this->request->getPost() as $key => $value) {
            $time_estimate = $this->transaction_menu_model
            ->join('menu' , 'menu.id = transaction_menu.menu_id')
            ->select("sum(time_estimate*transaction_menu.count) as time_estimate")
            ->where("transaction_id", $key)->get()->getRowArray();
            $this->transaction_model
                ->set('status' , 2)
                ->set('noted' , $value)
                ->set('time_estimate' , $time_estimate['time_estimate'])
                ->where('id' , $key)
                ->where('status' , 1)->update();
        }
        return redirect()->to(base_url('Pembeli/WaitingList'));
    }

    // public function payment_method()
    // {
    //     Config::$serverKey = 'SB-Mid-server-NPI0ax-Jopiu-YL-SrPGNJQI';
    //     Config::$isProduction = false;
    //     Config::$isSanitized = true;
    //     Config::$is3ds = true;

    //     $param = [
    //         "transaction_details" => [
    //             "order_id" => rand(),
    //             "gross_amount" => 100000,
    //             "refund_key" => rand()
    //         ],
    //     ];

    //     $data = [
    //         "snapToken" => Snap::getSnapToken($param)
    //     ];

    //     return view('Pembeli/pay/payment_method', $data);
    // }

    // public function cancelPayment()
    // {
    //     Config::$serverKey = 'SB-Mid-server-NPI0ax-Jopiu-YL-SrPGNJQI';
    //     Config::$isProduction = false;
    //     Config::$isSanitized = true;
    //     Config::$is3ds = true;

    //     $params = array(
    //         'refund_key' => 'order1-ref1',
    //         'amount' => 10000,
    //         'reason' => 'Item out of stock'
    //     );

    //     $refund = Transaction::refundDirect("379226964", $params);
    //     dd($refund);
    // }

}
