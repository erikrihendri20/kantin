<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionTopingModel extends Model
{
    protected $table      = 'transaction_toping';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['transaction_menu_id' , 'toping_id' , 'price'];

    protected $protectFields = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function checkToping($transaction_menu_id , $toping_id)
    {
        return $this->builder()
        ->where('transaction_menu_id' , $transaction_menu_id)
        ->where('toping_id' , $toping_id)
        ->get()
        ->getRowArray();
    }
    
    public function getTopingTransaction($user_id)
    {
        return $this->builder()
        ->join('transaction_menu' , 'transaction_toping.transaction_menu_id=transaction_menu.id')
        ->join('transaction' , 'transaction_menu.transaction_id=transaction.id')
        ->where('transaction.status',1)
        ->where('transaction.user_id',$user_id)
        ->select('transaction_menu.menu_id as menu_id , 
        transaction_toping.toping_id')
        ->get()
        ->getResultArray();
    }

    
}