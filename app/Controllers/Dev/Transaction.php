<?php

namespace App\Controllers\Dev;

use App\Controllers\BaseController;
use App\Models\TransactionMenuModel;

use App\Models\TransactionModel;
use App\Models\TransactionTopingModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Transaction extends ResourceController
{
    use ResponseTrait;

    protected $transaction_model = null;
    protected $transaction_menu_model = null;
    protected $transaction_toping_model = null;

    public function __construct()
    {
        $this->transaction_model = new TransactionModel();
        $this->transaction_menu_model = new TransactionMenuModel();
        $this->transaction_toping_model = new TransactionTopingModel();
    }

    public function index()
    {
        $time = time();
        $rand = rand();
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');
        $status = $this->request->getGet('status');
        if($start_date && $end_date){
            $start_date = $start_date.' 23:59:59';
            $end_date = $end_date.' 23:59:59';
            if($status){
                $transaction = $this->transaction_model
                ->select('transaction.id as id, transaction.status as status, transaction.updated_at as date , transaction.user_id as user_id')
                ->where('transaction.status', $status)
                ->where('transaction.updated_at BETWEEN "'.$start_date.'" AND "'.$end_date.'"')->get()->getResultArray();
            }else{
                $transaction = $this->transaction_model
                ->select('transaction.id as id, transaction.status as status, transaction.updated_at as date , transaction.user_id as user_id')
                ->where('transaction.updated_at BETWEEN "'.$start_date.'" AND "'.$end_date.'"')->get()->getResultArray();

            }
            $transaction_menu = $this->transaction_menu_model
            ->select('transaction_menu.id as id, transaction_menu.transaction_id, transaction_menu.name as name, transaction_menu.price as price, transaction_menu.count as count, transaction_menu.updated_at as date')
            ->where('transaction_menu.updated_at >= "'.$start_date.'" AND transaction_menu.updated_at <= "'.$end_date.'"')
            ->get()->getResultArray();
            $transaction_toping = $this->transaction_toping_model
            ->join('toping' , 'toping.id = transaction_toping.toping_id')
            ->select('transaction_toping.id as id, transaction_toping.transaction_menu_id as transaction_menu_id, toping.name as toping_name, transaction_toping.price, transaction_toping.updated_at as date')
            ->where('transaction_toping.updated_at >= "'.$start_date.'" AND transaction_toping.updated_at <= "'.$end_date.'"')
            ->get()->getResultArray();
        }elseif(!$start_date && !$end_date){
            if($status){
                $transaction = $this->transaction_model
                ->where('transaction.status', $status)
                ->select('transaction.id as id, transaction.status as status, transaction.updated_at as date, transaction.user_id as pembeli')->get()->getResultArray();
            }else{
                $transaction = $this->transaction_model
                ->select('transaction.id as id, transaction.status as status, transaction.updated_at as date, transaction.user_id as pembeli')->get()->getResultArray();
            }
            $transaction_menu = $this->transaction_menu_model
            ->select('transaction_menu.id as id, transaction_menu.transaction_id, transaction_menu.name as name, transaction_menu.price as price, transaction_menu.count as count, transaction_menu.updated_at as date')->get()->getResultArray();
            $transaction_toping = $this->transaction_toping_model
            ->join('toping' , 'toping.id = transaction_toping.toping_id')
            ->select('transaction_toping.id as id, transaction_toping.transaction_menu_id as transaction_menu_id, toping.name as toping_name, transaction_toping.price, transaction_toping.updated_at as date')->get()->getResultArray();
        }else{
            return $this->fail('Please input start date and end date correctly');
        }
        foreach ($transaction as $transaction_key => $transaction_value) {
            $transaction_menu_temp = array_filter($transaction_menu, function($transaction_menu_value) use ($transaction_value) {
                return $transaction_menu_value['transaction_id'] == $transaction_value['id'];
            });
            foreach ($transaction_menu_temp as $transaction_menu_key => $transaction_menu_value) {
                $transaction_toping_temp = array_filter($transaction_toping, function($transaction_toping_value) use ($transaction_menu_value) {
                    return $transaction_toping_value['transaction_menu_id'] == $transaction_menu_value['id'];
                });
                foreach ($transaction_toping_temp as $transaction_toping_key => $transaction_toping_value) {
                    unset($transaction_toping_temp[$transaction_toping_key]['id']);
                    unset($transaction_toping_temp[$transaction_toping_key]['transaction_menu_id']);
                    unset($transaction_toping_temp[$transaction_toping_key]['date']);
                }
                unset($transaction_menu_temp[$transaction_menu_key]['id']);
                unset($transaction_menu_temp[$transaction_menu_key]['transaction_id']);
                unset($transaction_menu_temp[$transaction_menu_key]['date']);
                $transaction_menu_temp[$transaction_menu_key]['toping'] = array_values($transaction_toping_temp);
            }
            unset($transaction[$transaction_key]['id']);
            $transaction[$transaction_key]['pembeli'] = md5($rand.$transaction_value['pembeli'] . $time);
            $transaction[$transaction_key]['menu'] = array_values($transaction_menu_temp);
        }
        return $this->respond([
            'status' => 200,
            'data-availability' => count($transaction) > 0 ? "available" : "not available",
            'data' => $transaction
        ]);
    }
    
}