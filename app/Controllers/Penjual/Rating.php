<?php

namespace App\Controllers\Penjual;
use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\UserLogModel;
use CodeIgniter\API\ResponseTrait;

class Rating extends BaseController
{
    use ResponseTrait;
    protected $transaction_model = null;
    protected $user_log_model = null;

    public function __construct()
    {
        $this->transaction_model = new TransactionModel();
        $this->user_log_model = new UserLogModel();
    }

    public function index()
    {
        $data = [
            'header_title' => 'Rating | Kantin STIS',
            'active' => 'Rating',
            'nav' => [
                [
                    'title' => 'Rating',
                    'url' => 'Penjual/Rating'
                ],
            ],
            'plugins' => [
                'datatable'
            ],
            'visitor' => count($this->user_log_model->getVisitor()),
            'rating' => $this->transaction_model
            ->select('transaction.rating as rating, transaction.comment as comment , users.name as name')
            ->join('users', 'users.id = transaction.user_id')
            ->where('transaction.status', '5')
            ->where('transaction.rating !=', null)
            ->where('transaction.canteen_id', session()->id)
            ->orderBy('transaction.updated_at', 'DESC')
            ->get()->getResultArray(),
            'styles' => 'penjual/rating/index',
            'scripts' => 'penjual/rating/index'
        ];
        return view('penjual/rating/index' , $data);  
    }
}
